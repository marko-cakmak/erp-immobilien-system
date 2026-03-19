<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentStatus;
use App\Models\Besichtigung;
use App\Models\InterestedPerson;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $wohnungenGesamt       = Apartment::count();
        $interessenten        = InterestedPerson::count();
        $aufgabenGesamt       = Task::count();
        $besichtigungenHeute  = Besichtigung::whereDate('besichtigung_at', today())->count();

        $wohnungsstatus = ApartmentStatus::withCount('apartments')->get()
            ->map(fn ($s) => [
                'label' => $s->label,
                'count' => $s->apartments_count,
                'color' => $s->color,
            ]);

        $aufgabenstatus = TaskStatus::withCount('tasks')->get()
            ->map(fn ($s) => [
                'name'  => $s->name,
                'count' => $s->tasks_count,
                'color' => $s->color,
            ]);

        $meineAufgaben = Task::with(['type', 'status', 'apartment'])
            ->whereHas('activeAssignee', fn ($q) => $q->where('user_id', Auth::id()))
            ->whereNull('closed_at')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'wohnungenGesamt',
            'interessenten',
            'aufgabenGesamt',
            'besichtigungenHeute',
            'wohnungsstatus',
            'aufgabenstatus',
            'meineAufgaben',
        ));
    }
}
