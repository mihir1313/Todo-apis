<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('user_id');

        if ($userId) {
            $todos = Todo::where('user_id', $userId)->get();
            return response()->json($todos);
        }
        return response()->json(['message' => 'User ID not provided'], 400);
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'completed' => 'required|boolean',
        ]);

        // Create a new todo
        $todo = new Todo();
        $todo->title = isset($request->title) ? $request->title : '';
        $todo->user_id = Auth::id();;
        $todo->description = isset($request->description) ? $request->description : '';
        $todo->completed = isset($request->completed) ? $request->completed : false;
        $todo->created_at = Carbon::now();
        $todo->save();

        // Response
        return response()->json([
            'message' => 'Todo added successfully',
            'status' => 'success',
            'data' => $todo,
        ], 201);
    }


    public function update(Request $request, Todo $todo)
    {
        // Authorize for update
        // $this->authorize('update', $todo);
        // Validation
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string|max:1000',
            'completed' => 'sometimes|required|boolean',
        ]);

        // Update todo
        $todo = Todo::where('id', $todo->id)->first();
        $todo->title = isset($request->title) ? $request->title : $todo->title;
        $todo->description = isset($request->description) ? $request->description : $todo->description;
        $todo->completed = isset($request->completed) ? $request->completed : $todo->completed;
        $todo->updated_at = Carbon::now();
        
        // Save the changes to the Todo item
        $todo->save();

        // Response
        return response()->json([
            'message' => 'Todo updated successfully',
            'status' => 'success',
            'data' => $todo,
        ], 200);
    }


    public function edit($id)
    {
        $todo = Todo::where('id', $id)->first();
        
        return response()->json($todo, 200);
    }

    public function delete(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted successfully',
            'status' => 'success'
        ], 200);
    }
}
