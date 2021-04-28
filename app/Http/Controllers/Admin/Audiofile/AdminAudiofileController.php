<?php

namespace App\Http\Controllers\Admin\Audiofile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiofile\AudiofileCreateRequest;
use App\Http\Resources\Admin\Audiofile\AdminAudiofileCollection;
use App\Http\Resources\Admin\Audiofile\AdminAudiofileResource;
use App\Models\Audiofile;
use Illuminate\Http\Request;
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
            $name = \Str::random(40);
            $size = $file->getSize();
            $extension = $file->getClientOriginalExtension();
            $fileName = $name . '.' . $extension;
            $path = $file->storeAs('files/audio/01', $fileName);

            $audiofile = Audiofile::create([
                'name' => $name,
                'path' => 'files/audio/01',
                'size' => $size,
                'ext' => $extension,
            ]);
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
     * @param  int  $id
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
        $path = $audiofile->path . $audiofile->name . '.' . $audiofile->ext;
        \Storage::delete($path);
        $audiofile->delete();

        return response(null, 204);
    }
}
