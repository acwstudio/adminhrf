<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\AdminUserCollection;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminUserCollection
     */
    public function index(Request $request)
    {
        $this->authorize('manage', User::class);

        $perPage = $request->get('per_page');

        $users = QueryBuilder::for(User::class)
            ->allowedIncludes([
                'socials', 'role', 'permissions', 'comments', 'image'
            ])
            ->allowedFilters([
                'role', 'permissions', 'email'
            ])
            ->allowedSorts(['id', 'name', 'created_at'])
            ->jsonPaginate($perPage);

        return new AdminUserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setStatus(Request $request, User $user)
    {
        $this->authorize('manage', User::class);

        $status = $request->post('status');

        if ($user->changeStatus($status)) {
            return response('Status changed', 201);
        }

        return response('Wrong status', 403);

    }
}
