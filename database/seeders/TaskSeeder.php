<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $tasks = [
            [
                'title' => 'Complete Laravel Project',
                'description' => 'Finish building the Task Module with AJAX and API',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Write README',
                'description' => 'Document setup, architecture, and API usage',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Create Seeder',
                'description' => 'Seed sample tasks into the database',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Test API',
                'description' => 'Verify all endpoints in Postman',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        // Insert all tasks in one query
        Task::insert($tasks);
    }
}
