<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return VideoResource::collection($user->videos());
    }
}
