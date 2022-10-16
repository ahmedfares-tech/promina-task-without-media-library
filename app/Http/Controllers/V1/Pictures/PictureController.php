<?php

namespace App\Http\Controllers\V1\Pictures;

use App\Helpers\ResolveResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Pictures\StorePicturesRequest;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    use ResolveResponseTrait;
    public function store(StorePicturesRequest $request, Album $album)
    {
        $user = auth()->user();

        $file = $request->file('file');

        $path = $user->name . '/' . $album->name . '/';

        $fileName   = $file->getClientOriginalName();

        $storage = Storage::disk('public')->put($path . $fileName, $file);

        $filePath   = 'storage/' . $storage;


        Picture::create(['name' => $file->getClientOriginalName(), 'picture' => $filePath, 'album_id' => $album->id]);

        return $this->resolveResponse('pages.index', $album, 'album.index', $album->slug);
    }
    public function destroy(Picture $picture)
    {
        $picture->delete();
        return redirect()->back();
    }
}
