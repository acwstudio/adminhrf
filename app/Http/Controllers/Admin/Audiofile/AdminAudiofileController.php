<?php

namespace App\Http\Controllers\Admin\Audiofile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiofile\AudiofileCreateRequest;
use App\Http\Resources\Admin\Audiofile\AdminAudiofileCollection;
use App\Http\Resources\Admin\Audiofile\AdminAudiofileResource;
use App\Models\Audiofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminAudiofileController
 * @package App\Http\Controllers\Admin\Audiofile
 */
class AdminAudiofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminAudiofileCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $audiofiles = QueryBuilder::for(Audiofile::class)
            ->allowedIncludes(['audiomaterial'])
            ->allowedSorts(['id', 'name'])
            ->jsonPaginate($perPage);

        return new AdminAudiofileCollection($audiofiles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AudiofileCreateRequest $request)
    {

        $file = $request->file('audio');

        if ($request->hasFile('audio')){
            $name = Str::random(40);
            $size = $file->getSize();
            $extension = $file->getClientOriginalExtension();
            $fileName = $name . '.' . $extension;
            $path = $this->dirById(Audiofile::max('id') + 1);

            if ($file->storeAs($path, $fileName)) {

                $audiofile = Audiofile::create(
                    [
                        'path' => $path . '/' . $fileName,
                        'size' => $size
                    ]
                );
            }

        }

        return (new AdminAudiofileResource($audiofile))
            ->response()
            ->header('Location', route('admin.audiofiles.show', [
                'audiofile' => $audiofile->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Audiofile $audiofile
     * @return AdminAudiofileResource
     */
    public function show(Audiofile $audiofile)
    {
        $query = QueryBuilder::for(Audiofile::class)
            ->where('id', $audiofile->id)
            ->allowedIncludes(['audiomaterial'])
            ->firstOrFail();

        return new AdminAudiofileResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Audiofile $audiofile
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Audiofile $audiofile)
    {

        $audiofile->delete();

        return response(null, 204);
    }


    /**
     * Return audiofile directory name by id
     *
     * @param int $id
     * @return string
     */
    protected function dirById(int $id)
    {
        return 'files/audio/' . Str::padLeft((string) ceil($id/1000), 2, '0');
    }
}
