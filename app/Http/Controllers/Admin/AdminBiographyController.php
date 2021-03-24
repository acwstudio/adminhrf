<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BiographyCreateRequest;
use App\Http\Requests\BiographyUpdateRequest;
use App\Http\Resources\Admin\AdminBiographyCollection;
use App\Http\Resources\Admin\AdminBiographyResource;
use App\Models\Biography;
use Illuminate\Http\Request;

class AdminBiographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminBiographyCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        return new AdminBiographyCollection(Biography::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BiographyCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BiographyCreateRequest $request)
    {
        $data = $request->validated();

        $biography = Biography::create($data['data']);

        return (new AdminBiographyResource($biography))
            ->response()
            ->header('Location', route('admin.biographies.show', [
                'biography' => $biography
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Biography $biography
     * @return AdminBiographyResource
     */
    public function show(Biography $biography)
    {
        return new AdminBiographyResource($biography);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BiographyUpdateRequest $request
     * @param Biography $biography
     * @return AdminBiographyResource
     */
    public function update(BiographyUpdateRequest $request, Biography $biography)
    {
        $data = $request->validated();

        $biography->update($data['data']);

        return new AdminBiographyResource($biography);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Biography $biography
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Biography $biography)
    {
        $biography->delete();
        return response(null, 204);
    }
}
