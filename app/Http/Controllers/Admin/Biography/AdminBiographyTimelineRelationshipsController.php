<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biography\BiographyTimelineUpdateRelationshipsRequest;
use App\Http\Resources\Admin\TimeLine\AdminTimelineIdentifierResource;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographyTimelineRelationshipsController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyTimelineRelationshipsController extends Controller
{
    /**
     * @param Biography $biography
     * @return AdminTimelineIdentifierResource
     */
    public function index(Biography $biography)
    {
        return new AdminTimelineIdentifierResource($biography->timeline);
    }

    /**
     * @param BiographyTimelineUpdateRelationshipsRequest $request
     * @param Biography $biography
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BiographyTimelineUpdateRelationshipsRequest $request, Biography $biography)
    {
        return response('Обновление ленты времени для биографии отключено', 405);
    }
}
