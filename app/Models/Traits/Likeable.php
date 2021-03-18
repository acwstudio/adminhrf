<?php


namespace App\Models\Traits;


trait Likeable
{

    public function incrementLikedCounter($qty = 1)
    {
        $this->increment('liked', $qty);
    }

    public function decrementLikedCounter($qty = 1)
    {
        $this->decrement('liked', $qty);
    }

}
