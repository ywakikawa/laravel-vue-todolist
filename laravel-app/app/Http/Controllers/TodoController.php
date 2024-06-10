<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :JsonResponse//get
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //post
    {
        $todo = Todo::create($request->all());
        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) //put
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->all());
        return response()->json($todo, 200);
//        $todo = Todo::where('id', $id)->update($request->all());
//        return response()->json($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        Todo::findOrFail($id)->delete(); //vueから持ってきたidを見つけてきて削除
        return response()->json(null, 204); //メッセージを返しているだけ
    }
}
