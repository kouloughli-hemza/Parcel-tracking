<?php

namespace Dsone\Http\Controllers\Web\Users;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Dsone\Events\User\UpdatedByAdmin;
use Dsone\Http\Controllers\Api\ApiController;
use Dsone\Repositories\User\UserRepository;
use Dsone\Services\Upload\UserAvatarManager;
use Dsone\User;

/**
 * Class AvatarController
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
        $this->users = $users;
        $this->avatarManager = $avatarManager;
    }

    /**
     * Update user's avatar from uploaded image.
     *
     * @param User $user
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, ['avatar' => 'image']);

        $name = $this->avatarManager->uploadAndCropAvatar(
            $request->file('avatar'),
            $request->get('points')
        );

        if ($name) {
            $this->users->update($user->id, ['avatar' => $name]);

            event(new UpdatedByAdmin($user));

            return redirect()->route('users.edit', $user)
                ->withSuccess(__('Avatar changed successfully.'));
        }

        return redirect()->route('users.edit', $user)
            ->withErrors(__('Avatar image cannot be updated. Please try again.'));
    }

    /**
     * Update user's avatar from some external source (Gravatar, Facebook, Twitter...)
     *
     * @param User $user
     * @param Request $request
     * @return mixed
     */
    public function updateExternal(User $user, Request $request)
    {
        $this->avatarManager->deleteAvatarIfUploaded($user);

        $this->users->update($user->id, ['avatar' => $request->get('url')]);

        event(new UpdatedByAdmin($user));

        return redirect()->route('users.edit', $user)
            ->withSuccess(__('Avatar changed successfully.'));
    }
}
