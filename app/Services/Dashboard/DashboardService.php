<?php

namespace App\Services\Dashboard;

use App\Models\Apartment;
use App\Models\ApartmentStatus;
use App\Models\Besichtigung;
use App\Models\InterestedPerson;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    public function getDashboardData(int $userId): array
    {
        return Cache::remember("dashboard_data_{$userId}", now()->addMinutes(5), function () use ($userId) {
            $myTasks = $this->getMyTasksData($userId);

            return [
                'wohnungenGesamt'     => $this->getApartmentsCount(),
                'interessenten'       => $this->getInterestedPersonsCount(),
                'aufgabenGesamt'      => $this->getTasksCount(),
                'besichtigungenHeute' => $this->getTodayVisitsCount(),
                'wohnungsstatus'      => $this->getApartmentStatuses(),
                'aufgabenstatus'      => $this->getTaskStatuses(),
                'meineAufgaben'       => $myTasks['meineAufgaben'],
                'meineAufgabenGesamt' => $myTasks['meineAufgabenGesamt'],
            ];
        });
    }

    private function getApartmentsCount(): int
    {
        return Apartment::count();
    }

    private function getInterestedPersonsCount(): int
    {
        return InterestedPerson::count();
    }

    private function getTasksCount(): int
    {
        return Task::count();
    }

    private function getTodayVisitsCount(): int
    {
        return Besichtigung::whereDate('besichtigung_at', today())->count();
    }

    private function getApartmentStatuses(): Collection
    {
        return ApartmentStatus::withCount('apartments')->get()
            ->map(fn ($s) => [
                'label' => $s->label,
                'count' => $s->apartments_count,
                'color' => $s->color,
            ]);
    }

    private function getTaskStatuses(): Collection
    {
        return TaskStatus::withCount('tasks')->get()
            ->map(fn ($s) => [
                'name'  => $s->name,
                'count' => $s->tasks_count,
                'color' => $s->color,
            ]);
    }

    private function getMyTasksQuery(int $userId)
    {
        return Task::whereHas('activeAssignee', fn ($q) => $q->where('user_id', $userId))
            ->whereHas('status', fn ($q) => $q->where('name', 'Neu'))
            ->whereNull('closed_at');
    }

    private function getMyTasksData(int $userId): array
    {
        $query = $this->getMyTasksQuery($userId);

        return [
            'meineAufgabenGesamt' => (clone $query)->count(),
            'meineAufgaben' => $query
                ->with(['type', 'status', 'apartment'])
                ->latest()
                ->take(3)
                ->get(),
        ];
    }
}
