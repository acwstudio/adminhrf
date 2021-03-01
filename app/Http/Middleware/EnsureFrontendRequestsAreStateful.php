<?php

namespace App\Http\Middleware;


use Illuminate\Support\Facades\App;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful as BaseSanctumMiddleware;

class EnsureFrontendRequestsAreStateful extends BaseSanctumMiddleware
{


    /**
     * Override parent method to make it look like request is from front end if we are running from a phpunit test
     *
     * @inheritDoc
     */
    public static function fromFrontend($request): bool
    {
        return App::environment('testing') ? true : parent::fromFrontend($request);
    }
}
