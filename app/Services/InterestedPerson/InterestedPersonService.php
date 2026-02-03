<?php

namespace App\Services\InterestedPerson;

use App\Models\InterestedPerson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InterestedPersonService
{
    public function search(Request $request)
    {
        $query = InterestedPerson::with(['apartments']);

        $this->applySearchFilters($query, $request);

        return $query->orderBy('created_at', 'desc')->get();
    }

    protected function applySearchFilters(Builder $query, Request $request): void
    {
        if ($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
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
}
