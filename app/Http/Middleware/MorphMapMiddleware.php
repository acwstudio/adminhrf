<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MorphMapMiddleware
{
    /**
     * Change model_type and commentable_type in request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // Mappings for model_type and commentable_type

        $map = collect([
            'audiomaterial' => ['audiolecture'],
            'videomaterial' => ['videolecture', 'film'],
            'highlight' => ['course', 'audiocourse', 'videocourse', 'highlight']

        ]);

        $modelType = $request->get('model_type') ?: $request->get('commentable_type') ?: null;

        if (!is_null($modelType)) {

            $newType = $map->search(function ($item, $key) use ($modelType) {
                if (in_array($modelType, $item)) {
                    return $key;
                }
                return false;
            });

            if ($newType) {
                $request->merge(['commentable_type' => $newType, 'model_type' => $newType]);
            }
        }

        return $next($request);
    }
}
