<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $videos = Video::all();
        return VideoResource::collection($videos);
    }

    public function store(StoreVideoRequest $request): \Illuminate\Http\JsonResponse
    {
        $id = Auth::id();
//        dd($id);
        $video = $request->validated();
        $video['user_id'] = $id;
        $video['video'] = Storage::put('/videos', $video['video']);
        Video::firstOrCreate($video);
        return response()->json([
            'success' => true,
            'message' => 'successful created video'
        ]);
    }

    public function show(Video $video)
    {
        return new VideoResource::($video);
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
//        dd(Storage::delete($video->video));
        $id = Auth::id();
        if ($id == $video->user_id) {
            Storage::delete($video->video);
            $video->delete();
            return response()->json([
                'success' => true,
                'message' => 'successful delete'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'something went wrong'
            ]);
        }
    }


}
