<?php


namespace App\Models\Traits;


use App\Models\Like;
use App\Models\Rate;
use App\Models\User;

/**
 * Trait Rateable
 * @package App\Models\Traits
 *
 * To add rate functionality just add this trait to your model and make int column 'rate' in corresponding table
 */
trait Rateable
{

    /**
     * Get rates relation
     */
    public function rates()
    {
        return $this->morphMany(Rate::class, 'rateable');
    }


    public function incrementRateCounter($qty = 1)
    {
        $this->increment('rate', $qty);
    }

    /**
     * Check if model is rated by given user
     * @param User $user
     * @return integer
     */
    public function checkRated(User $user)
    {
        return !is_null($rate = $this->rates()->firstWhere('user_id', $user->id)) ? $rate->rate : 0 ;
    }

    /**
     * Get rate count
     */
    public function countRate()
    {
        return $this->rates()->sum('rate');
    }

}
