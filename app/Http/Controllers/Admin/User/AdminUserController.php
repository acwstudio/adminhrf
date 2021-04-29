<?php

namespace App\Http\Controllers\Admin\User;

use App\Filters\FiltersUserPermission;
use App\Filters\FiltersUserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Resources\Admin\User\AdminUserCollection;
use App\Http\Resources\Admin\User\AdminUserResource;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminUserCollection
     * @throws AuthorizationException
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
                AllowedFilter::custom('permission', new FiltersUserPermission),
                AllowedFilter::custom('role', new FiltersUserRole),
                'email',
                'status'
            ])
            ->allowedSorts(['id', 'name', 'created_at'])
            ->jsonPaginate($perPage);

        return new AdminUserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return AdminUserResource
     */
    public function store(UserCreateRequest $request)
    {
        $this->authorize('manage', User::class);

        $data = $request->input('data.attributes');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'status' => $data['status'],
            'email_verified_at' => now()
        ]);

        $permissions = $request->input('data.relationships.permissions.data.*.id');
        if (!empty($permissions)) {
            $user->permissions()->attach($permissions);
        }

        $images = $request->input('data.relationships.images.data.*.id');
        if (!empty($images)) {
            $user->image()->save(Image::find($images[0]));
        }


        return AdminUserResource::make($user->refresh());

    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return AdminUserResource
     * @throws AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize('manage', User::class);

        $user = QueryBuilder::for(User::class)
            ->where('id', $user->id)
            ->allowedIncludes([
                'socials', 'role', 'permissions', 'comments', 'image'
            ])
            ->firstOrFail();

        return AdminUserResource::make($user);
    }

    /**
     * Update user.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return AdminUserResource
     * @throws AuthorizationException
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        $this->authorize('manage', User::class);

        $data = Arr::only($request->input('data.attributes'), ['name', 'role_id', 'status']);

        $user->update($data);

        if ($password = $request->input('data.attributes.password')) {

            $user->password = Hash::make($password);
            $user->save();
            $user->tokens()->delete();

        }

        $permissions = $request->input('data.relationships.permissions.data.*.id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        return AdminUserResource::make($user->refresh());
    }

    /**
     * Remove user and all relationships.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->image()->delete();
        $user->permissions()->detach();
        $user->comments()->delete();
        $user->subscriptions()->delete();
        $user->testResults()->delete();
        $user->tokens()->delete();
        $user->socials()->delete();

        if ($bookmarkGroup = $user->bookmarkGroup) {
            $bookmarkGroup->bookmarks()->delete();
            $bookmarkGroup->delete();
        }

        $user->delete();

        return response(null, 204);
    }

    /**
     *
     * Change user status
     *
     * @param Request $request
     * @param User $user
     * @return Response
     * @throws AuthorizationException
     */
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
