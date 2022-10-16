<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'parent_id'
    ];
    protected $append = ['dataCount'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // * Relations
    // ! picture Relation
    public function pictures()
    {
        return $this->hasMany(Picture::class, 'album_id', 'id');
    }
    // ! children albums
    public function childrenAlbums()
    {
        return $this->hasMany(Album::class, 'parent_id', 'id');
    }
    // ! parent album
    public function parentAlbum()
    {
        return $this->hasOne(Album::class, 'id', 'parent_id');
    }
    public function parentOfParent()
    {
        return $this->parentAlbum()->with('parentOfParent');
    }
    public function getDataCountAttribute()
    {
        
        return count($this->pictures) + count($this->childrenAlbums);
    }
}
