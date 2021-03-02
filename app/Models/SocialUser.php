<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialUser extends Model
{
    use HasFactory;


    /**
     * Social services
     */
    const FB = 'facebook';
    const OK = 'odnoklassniki';
    const VK = 'vkontakte';
    const GOOGLE = 'google';
    const YANDEX = 'yandex';
    const TWITTER = 'twitter';

    protected $casts = [
        'external_user' => 'array',
    ];

    /**
     * Get user that owns social account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
