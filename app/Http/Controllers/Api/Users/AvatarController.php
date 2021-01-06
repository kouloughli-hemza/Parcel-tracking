<?php

namespace Dsone\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use Dsone\Events\User\UpdatedByAdmin;
use Dsone\Http\Controllers\Api\ApiController;
use Dsone\Http\Requests\User\UploadAvatarRawRequest;
use Dsone\Http\Resources\UserResource;
use Dsone\Repositories\User\UserRepository;
use Dsone\Services\Upload\UserAvatarManager;
use Dsone\User;

/**
 * @package Dsone\Http\Controllers\Api\Users
 */
class AvatarController extends ApiController
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var UserAvatarManager
     */
    private $avatarManager;

    public function __construct(UserRepository $users, UserAvatarManager $avatarManager)
    {
        $this->middleware('permission:users.manage');

        $this->users = $users;
        $this->avatarManager = $avatarManager;
    }

    /**
     * @param User $user
     * @param UploadAvatarRawRequest $request
     * @return UserResource
     */
    public function update(User $user, UploadAvatarRawRequest $request)
    {
        $name = $this->avatarManager->uploadAndCropAvatar($request->file('file'));

        $user = $this->users->update($user->id, ['avatar' => $name]);

        event(new UpdatedByAdmin($user));

        return new UserResource($user);
    }

    /**
     * Update user's avatar to external resource.
     *
     * @param User $user
     * @param Request $request
     * @return UserResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateExternal(User $user, Request $request)
    {
        $this->validate($request, ['url' => 'required|url']);

        $this->avatarManager->deleteAvatarIfUploaded($user);

        $user = $this->users->update($user->id, ['avatar' => $request->url]);

        event(new UpdatedByAdmin($user));

        return new UserResource($user);
    }

    /**
     * Remove user's avatar and set it to null.
     *
     * @param User $user
     * @return UserResource
     */
    public function destroy(User $user)
    {
        $this->avatarManager->deleteAvatarIfUploaded($user);

        $user = $this->users->update($user->id, ['avatar' => null]);

        event(new UpdatedByAdmin($user));

        return new UserResource($user);
    }
}
