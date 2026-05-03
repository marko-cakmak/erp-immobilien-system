<?php

namespace App\Services\Apartment;

use App\Models\Apartment;
use App\Models\ApartmentImage;
use Illuminate\Database\Eloquent\Builder;
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

    public function search(Request $request)
    {
        $query = Apartment::with(['coverImage', 'status'])
            ->withCount(['interestedPersons', 'tasks']);

        $this->applySearchFilters($query, $request);

        return $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
    }

    protected function applySearchFilters(Builder $query, Request $request): void
    {
        if ($request->filled('internal_number')) {
            $query->where('internal_number', 'like', '%' . $request->internal_number . '%');
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('address')) {
            $terms = explode(' ', trim($request->address));
            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->where(function ($inner) use ($term) {
                        $inner->where('street_address', 'like', '%' . $term . '%')
                            ->orWhere('city', 'like', '%' . $term . '%')
                            ->orWhere('postal_code', 'like', '%' . $term . '%');
                    });
                }
            });
        }

        if ($request->filled('rooms')) {
            $query->where('rooms', $request->rooms);
        }

        if ($request->filled('size_from')) {
            $query->where('size_sqm', '>=', $request->size_from);
        }
        if ($request->filled('size_to')) {
            $query->where('size_sqm', '<=', $request->size_to);
        }

        if ($request->filled('rent_cold_from')) {
            $query->where('rent_cold', '>=', $request->rent_cold_from);
        }
        if ($request->filled('rent_cold_to')) {
            $query->where('rent_cold', '<=', $request->rent_cold_to);
        }

        if ($request->filled('rent_warm_from')) {
            $query->where('rent_warm', '>=', $request->rent_warm_from);
        }
        if ($request->filled('rent_warm_to')) {
            $query->where('rent_warm', '<=', $request->rent_warm_to);
        }

        if ($request->filled('status')) {
            $query->where('apartment_status_id', $request->status);
        }
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
                    'position' => (int)$position,
                    'is_cover' => ((int)$position === 0),
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
        $deleteImages = array_filter($deleteImages, fn($id) => !empty($id));

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
                'position' => (int)$position,
                'is_cover' => ((int)$position === 0),
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

    public function searchForAjax(Request $request): array
    {
        $query = Apartment::query();

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where('title', 'like', "%{$term}%");
        }

        return $query->orderBy('title')
            ->limit(10)
            ->get(['id', 'title', 'street_address', 'city', 'postal_code'])
            ->toArray();
    }
}
