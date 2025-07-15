<?php

namespace App\Traits;

trait HasImageUrl
{
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }

        return asset('images/default.png');
    }
}
