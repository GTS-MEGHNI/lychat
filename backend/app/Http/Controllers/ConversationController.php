<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function list(Request $request, int $id): JsonResponse
    {
        return response()->json(User::with(['conversations.subscribers' => function ($query) use ($id) {
            $query->where(['user_id' => $id]);
        }])->find($id)->conversations->toArray());
    }
}
