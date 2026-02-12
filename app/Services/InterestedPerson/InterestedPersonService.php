<?php

namespace App\Services\InterestedPerson;

use App\Models\InterestedPerson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InterestedPersonService
{
    protected array $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'street_address',
        'postal_code',
        'city',
        'notes',
        'is_active',
    ];

    public function search(Request $request)
    {
        $query = InterestedPerson::with(['apartments']);

        $this->applySearchFilters($query, $request);

        return $query->orderBy('created_at', 'desc')->get();
    }

    protected function applySearchFilters(Builder $query, Request $request): void
    {
        if ($request->filled('name')) {
            $parts = preg_split('/\s+/', trim($request->name));

            $query->where(function ($q) use ($parts) {
                foreach ($parts as $part) {
                    $q->where(function ($sub) use ($part) {
                        $sub->where('first_name', 'like', "%{$part}%")
                            ->orWhere('last_name', 'like', "%{$part}%");
                    });
                }
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('address')) {
            $query->where('street_address', 'like', '%' . $request->address . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }
    }

    public function getActive()
    {
        return InterestedPerson::where('is_active', true)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
    }

    public function getForShow(InterestedPerson $interestedPerson): InterestedPerson
    {
        return $interestedPerson->load(['apartments.status']);
    }

    public function create(array $data): InterestedPerson
    {
        $data = $this->filterData($data);

        return InterestedPerson::create($data);
    }

    public function update(InterestedPerson $interestedPerson, array $data): InterestedPerson
    {
        $data = $this->filterData($data);

        $interestedPerson->update($data);

        return $interestedPerson->refresh();
    }

    public function delete(InterestedPerson $interestedPerson): void
    {
        $interestedPerson->delete();
    }

    protected function filterData(array $data): array
    {
        return array_intersect_key(
            $data,
            array_flip($this->allowedFields)
        );
    }
}
