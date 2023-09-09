<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\User;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->validated();
        $user['email_verified_at'] = now();
        $user['remember_token'] = Str::random(10);
        User::Create($user);
        return response()->json([
            'success' => true,
            'message' => 'successful registered'
        ]);
    }
}
