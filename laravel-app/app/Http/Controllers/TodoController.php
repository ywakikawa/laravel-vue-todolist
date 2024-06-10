<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function store(TodoRequest $request): JsonResponse
    {
        $todo = Todo::create($request->all());
        return response()->json($todo, 201);
    }

    public function update(TodoRequest $request, string $id):JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->all());
        return response()->json($todo, 200);

    }
    public function destroy(string $id):JsonResponse
    {
        Todo::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function completed(string $id):JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->update(['completed' => true]);
        return response()->json($todo, 200);
    }
}
