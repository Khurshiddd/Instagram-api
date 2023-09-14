<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\Video;

class LikeController extends Controller
{
    public function __invoke(Video $video)
    {
        auth()->user()->like()->toggle($video->id);
        return response()->json([
            'success' => true
            ]);
    }
}
