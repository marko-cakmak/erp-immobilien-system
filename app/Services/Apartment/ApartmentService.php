<?php

namespace App\Services\Apartment;

use App\Models\Apartment;
use App\Models\ApartmentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApartmentService
{
    protected array $allowedFields = [
        'title',
        'internal_number',
        'street_address',
        'postal_code',
        'city',
        'state',
        'floor',
        'rooms',
        'size_sqm',
        'year_built',
        'rent_cold',
        'rent_warm',
        'deposit',
        'apartment_status_id',
        'notes',
        'is_active',
    ];

    public function getAll()
    {
        return Apartment::with(['status', 'images'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getForShow(Apartment $apartment): Apartment
    {
        return $apartment->load(['status', 'images', 'coverImage']);
    }

    public function update(Apartment $apartment, array $data, Request $request): Apartment
    {
        return DB::transaction(function () use ($apartment, $data, $request) {

            $data = $this->filterData($data);
            $data['is_active'] = $request->has('is_active');

            $apartment->update($data);

            $this->handleImageDeletions($apartment, $request);
            $this->handleImageUploads($apartment, $request);
            $this->reorderImagePositions($apartment);

            return $apartment->refresh();
        });
    }

    public function create(array $data): Apartment
    {
        return DB::transaction(function () use ($data) {

            $data = $this->filterData($data);
            $apartment = Apartment::create($data);

            $tempImages = session()->pull('apartment_temp_images', []);

            foreach ($tempImages as $position => $path) {
                $newPath = str_replace('tmp/', '', $path);

                Storage::disk('public')->move($path, $newPath);

                $apartment->images()->create([
                    'path' => $newPath,
                    'position' => (int) $position,
                    'is_cover' => ((int) $position === 0),
                ]);
            }

            $this->reorderImagePositions($apartment);

            return $apartment->refresh();
        });
    }

    public function delete(Apartment $apartment): void
    {
        DB::transaction(function () use ($apartment) {

            foreach ($apartment->images as $image) {
                if (Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
            }

            $apartment->images()->delete();
            $apartment->delete();
        });
    }

    protected function handleImageDeletions(Apartment $apartment, Request $request): void
    {
        $deleteImages = $request->input('delete_images', []);
        $deleteImages = array_filter($deleteImages, fn ($id) => !empty($id));

        if (empty($deleteImages)) {
            return;
        }

        $imagesToDelete = ApartmentImage::whereIn('id', $deleteImages)
            ->where('apartment_id', $apartment->id)
            ->get();

        foreach ($imagesToDelete as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }

            $image->delete();
        }
    }

    protected function handleImageUploads(Apartment $apartment, Request $request): void
    {
        if (!$request->hasFile('images')) {
            return;
        }

        foreach ($request->file('images') as $position => $file) {
            if (!$file) {
                continue;
            }

            $path = $file->store('apartments', 'public');

            $apartment->images()->create([
                'path' => $path,
                'position' => (int) $position,
                'is_cover' => ((int) $position === 0),
            ]);
        }
    }

    protected function reorderImagePositions(Apartment $apartment): void
    {
        $images = $apartment->images()
            ->orderBy('position')
            ->get();

        foreach ($images as $index => $image) {
            if ($image->position !== $index) {
                $image->update(['position' => $index]);
            }
        }

        $this->ensureCoverImage($apartment);
    }

    protected function ensureCoverImage(Apartment $apartment): void
    {
        $hasCover = $apartment->images()->where('is_cover', true)->exists();

        if (!$hasCover) {
            $firstImage = $apartment->images()
                ->orderBy('position')
                ->first();

            if ($firstImage) {
                $firstImage->update(['is_cover' => true]);
            }
        }
    }

    protected function filterData(array $data): array
    {
        return array_intersect_key(
            $data,
            array_flip($this->allowedFields)
        );
    }
}
