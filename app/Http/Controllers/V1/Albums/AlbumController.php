<?php

namespace App\Http\Controllers\V1\Albums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Helpers\ResolveResponseTrait;
use App\Http\Requests\V1\Albums\DeleteAlbumRequest;
use App\Http\Requests\V1\Albums\StoreAlbumRequest;
use App\Http\Requests\V1\Albums\UpdateAlbumRequest;
use App\Http\Resources\V1\Albums\AlbumIndexResource;

class AlbumController extends Controller
{
    use resolveResponseTrait;
    public function main()
    {
        $album = Album::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->where('parent_id', null)->with(['childrenAlbums', 'parentAlbum', 'pictures'])->first();
        if (!$album) $album = Album::create([
            'name' => auth()->user()->name,
            'slug' => auth()->user()->name,
            'user_id' => auth()->user()->id
        ]);
        return $this->resolveResponse('pages.main', $album, 'album.index', $album);
    }
    public function index(Album $album)
    {
        $album->load(['childrenAlbums', 'parentAlbum', 'pictures']);

        return $this->resolveResponse('pages.index', $album);
    }
    public function store(StoreAlbumRequest $request, Album $album)
    {
        $album = Album::create(array_merge($request->all(), ['parent_id' => $album->id ?? null, 'user_id' => auth()->user()->id, 'slug' => $request->name]));

        return $this->resolveResponse('pages.index', $album, 'album.index', $album->slug);
    }
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        if ($album->user_id != auth()->user()->id) return redirect()->back();
        $album->update(array_merge($request->all(), ['slug' => $request->name]));
        return $this->resolveResponse('pages.index', $album, 'album.index', $album->slug);
    }
    public function destroy(DeleteAlbumRequest $request, Album $album)
    {
        if ($album->user_id != auth()->user()->id) return redirect()->back();
        switch ($request->deleteOption) {
            case '1':
                $album->pictures()->delete();
                $album->childrenAlbums()->delete();
                $album->delete();
                return $this->resolveResponse('pages.index', $album, 'album.index', $album->parentAlbum->slug);
                break;
            case '2':
                $album->pictures()->update(['album_id' => $album->parent_id]);
                $album->childrenAlbums()->update(['parent_id' => $album->parent_id]);
                $album->delete();
                return $this->resolveResponse('pages.index', $album, 'album.index', $album->parentAlbum->slug);
                break;
            case '3':
                $album->delete();
                return $this->resolveResponse('pages.index', $album, 'album.index', $album->parentAlbum->slug);
                break;
            default:
                return $this->resolveResponse('pages.index', $album, 'album.index', $album->parentAlbum->slug);
                break;
        }
    }
}
