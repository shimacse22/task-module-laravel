<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function createMultiple(array $tasks): void
    {
        $now = now();
        $rows = collect($tasks)->map(function ($t) use ($now) {
            return [
                'title' => $t['title'],
                'description' => $t['description'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->toArray();

        DB::transaction(function () use ($rows) {
            Task::insert($rows);
        });
    }

    public function getAll()
    {
        return Task::orderBy('id', 'desc')->get();
    }

    public function getById(int $id)
    {
        return Task::find($id);
    }

    public function updateById(int $id, array $data): bool
    {
        $task = Task::find($id);
        if (!$task) return false;

        // Update only the fields provided
        $task->title = $data['title'] ?? $task->title;
        $task->description = $data['description'] ?? $task->description;
        $task->save();

        return true;
    }

    public function deleteById(int $id): bool
    {
        $task = Task::find($id);
        if (!$task) return false;
        $task->delete();
        return true;
    }
}
