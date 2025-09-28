<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->getAll();
        return response()->json(['data' => $tasks], 200);
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            $this->taskService->createMultiple($request->tasks);

            return response()->json([
                'success' => true,
                'message' => 'Tasks created successfully'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create tasks',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $task = $this->taskService->getById($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json(['data' => $task], 200);
    }

     public function update(UpdateTaskRequest $request, $id)
    {
        $updated = $this->taskService->updateById($id, $request->validated());

        if (!$updated) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully'
        ], 200);
    }

    public function destroy($id)
    {
        $deleted = $this->taskService->deleteById($id);

        if (!$deleted) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Task deleted successfully'], 200);
    }
}
