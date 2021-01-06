<?php

namespace Dsone\Http\Controllers\Api\Authorization;

use Cache;
use Spatie\QueryBuilder\QueryBuilder;
use Dsone\Http\Controllers\Api\ApiController;
use Dsone\Http\Requests\Role\CreateRoleRequest;
use Dsone\Http\Requests\Role\RemoveRoleRequest;
use Dsone\Http\Requests\Role\UpdateRoleRequest;
use Dsone\Http\Resources\RoleResource;
use Dsone\Repositories\Role\RoleRepository;
use Dsone\Repositories\User\UserRepository;
use Dsone\Role;

/**
 * @package Dsone\Http\Controllers\Api\Users
 */
class RolesController extends ApiController
{
    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
        $this->middleware('permission:roles.manage');
    }

    /**
     * Get all system roles with users count for each role.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $roles = QueryBuilder::for(Role::class)
            ->allowedIncludes(RoleResource::allowedIncludes())
            ->allowedFilters(['name'])
            ->allowedSorts(['name', 'created_at'])
            ->defaultSort('created_at')
            ->paginate();

        return RoleResource::collection($roles);
    }

    /**
     * Create new role from the request.
     * @param CreateRoleRequest $request
     * @return RoleResource
     */
    public function store(CreateRoleRequest $request)
    {
        $role = $this->roles->create(
            $request->only(['name', 'display_name', 'description'])
        );

        return new RoleResource($role);
    }

    /**
     * Return info about specified role.
     * @param $id
     * @return RoleResource
     */
    public function show($id)
    {
        $role = QueryBuilder::for(Role::where('id', $id))
            ->allowedIncludes(RoleResource::allowedIncludes())
            ->first();

        return new RoleResource($role);
    }

    /**
     * Update specified role.
     * @param Role $role
     * @param UpdateRoleRequest $request
     * @return RoleResource
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $input = collect($request->all());

        $role = $this->roles->update(
            $role->id,
            $input->only(['name', 'display_name', 'description'])->toArray()
        );

        return new RoleResource($role);
    }

    /**
     * Remove specified role (if role is removable).
     * @param Role $role
     * @param UserRepository $users
     * @param RemoveRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role, UserRepository $users, RemoveRoleRequest $request)
    {
        $userRole = $this->roles->findByName('User');

        $users->switchRolesForUsers($role->id, $userRole->id);

        $this->roles->delete($role->id);

        Cache::flush();

        return $this->respondWithSuccess();
    }
}
