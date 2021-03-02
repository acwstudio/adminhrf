<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SocialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $services = ['facebook', 'vkontakte', 'odnoklassniki', 'yandex', 'google', 'twitter', 'github'];
        $enabledServices = [];

        foreach($services as $service) {
            if(config('services' . $service)) {
                $enabledServices[] = $service;
            }
        }

        if(!in_array(Str::lower($request->service), $enabledServices)) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid social service'
                ], 403);
        }


        return $next($request);
    }
}
