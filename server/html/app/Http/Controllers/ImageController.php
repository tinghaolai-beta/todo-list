<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoList;
use App\Http\Requests\UpdateTodoList;
use App\Models\TodoList;
use App\Services\UploadService;
use App\Services\TodoListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    protected $uploadService;

    public function __construct()
    {
        $this->middleware('auth');

        $this->uploadService = new UploadService();
    }

    public function upload(Request $request)
    {
        $valid = Validator::make($request->all(), ['file'=>'required|mimes:jpeg,png,jpg,gif']);
        if (!$valid->passes())
        {
            return response()->json([
                'status'  => 'fail',
                'message' => 'invalidParams',
            ]);
        }

        if (floor(filesize($request->file)) > 10485760)
        {
            return response()->json([
                'status'  => 'fail',
                'message' => 'sizeError',
            ]);
        }

        $result = $this->uploadService->upload($request->file);
        if (!$result) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'sizeError',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $result,
        ]);
    }
}
