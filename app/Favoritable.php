<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Favoritable
{
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $arrtributes = ['user_id' => auth()->id()];

        if (! $this->favorites()->where($arrtributes)->exists()){
            return $this->favorites()->create($arrtributes);
        }
    }

    public function isFavorited()
    {
        return ! ! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}