<?php

namespace Dsone\Http\Controllers\Api\Authorization;

use Dsone\Events\Role\PermissionsUpdated;
use Dsone\Http\Controllers\Api\ApiController;
use Dsone\Http\Requests\Role\UpdateRolePermissionsRequest;
use Dsone\Http\Resources\PermissionResource;
use Dsone\Repositories\Role\RoleRepository;
use Dsone\Role;

/**
 * @package Dsone\Http\Controllers\Api
 */
class RolePermissionsController extends ApiController
{
    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
        $this->middleware('permission:permissions.manage');
    }

    public function show(Role $role)
    {
        return PermissionResource::collection($role->cachedPermissions());
    }

    /**
     * Update specified role.
     * @param Role $role
     * @param UpdateRolePermissionsRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function update(Role $role, UpdateRolePermissionsRequest $request)
    {
        $this->roles->updatePermissions(
            $role->id,
            $request->permissions
        );

        event(new PermissionsUpdated);

        return PermissionResource::collection($role->cachedPermissions());
    }
}
