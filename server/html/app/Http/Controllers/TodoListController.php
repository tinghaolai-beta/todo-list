<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoList;
use App\Http\Requests\UpdateTodoList;
use App\Models\TodoList;
use App\Services\TodoListService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    protected $todoListService;

    public function __construct()
    {
        $this->middleware('auth');

        $this->todoListService = new TodoListService();
    }

    public function getList(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->todoListService->getList(
                ($request->perPage) ? $request->perPage : 10
            ),
        ]);
    }

    public function get($id)
    {
        $result = $this->todoListService->get($id);
        if ($result instanceof TodoList) {
            return response()->json([
                'status' => 'success',
                'data'   => $result,
            ]);
        }

        return response()->json([
            'status'  => 'fail',
            'message' => $result,
        ]);
    }

    public function store(StoreTodoList $request)
    {
        if ($this->todoListService->store($request->title, $request->todoContent, auth()->user())) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'fail']);
    }

    public function update($id, UpdateTodoList $request)
    {
        $result = $this->todoListService->update($id, $request->title, $request->title, auth()->user());
        if ($result !== 'success') {
            return response()->json([
                'status'  => 'fail',
                'message' => $result,
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function delete($id)
    {
        $result = $this->todoListService->delete($id);
        if ($result !== 'success') {
            return response()->json([
                'status'  => 'fail',
                'message' => $result,
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
