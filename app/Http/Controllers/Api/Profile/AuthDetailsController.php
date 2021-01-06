<?php

namespace Dsone\Http\Controllers\Api\Profile;

use Dsone\Http\Controllers\Api\ApiController;
use Dsone\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use Dsone\Http\Resources\UserResource;
use Dsone\Repositories\User\UserRepository;

/**
 * @package Dsone\Http\Controllers\Api\Profile
 */
class AuthDetailsController extends ApiController
{
    /**
     * Updates user profile details.
     *
     * @param UpdateProfileLoginDetailsRequest $request
     * @param UserRepository $users
     * @return UserResource
     */
    public function update(UpdateProfileLoginDetailsRequest $request, UserRepository $users)
    {
        $user = $request->user();

        $data = $request->only(['email', 'username', 'password']);

        $user = $users->update($user->id, $data);

        return new UserResource($user);
    }
}
