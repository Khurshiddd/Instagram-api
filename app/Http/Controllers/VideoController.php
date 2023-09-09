<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $videos = Video::all();
        return response($videos);
    }

    public function store(StoreVideoRequest $request): \Illuminate\Http\JsonResponse
    {
        $video = $request->validated();
        $video['user_id'] = Auth::id();
        $video['video'] = Storage::put('/videos', $video['video']);
        Video::Create($video);
        return response()->json([
            'success' => true,
            'message' => 'successful created video'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
