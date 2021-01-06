<?php

namespace Dsone\Http\Controllers\Web\Users;

use Illuminate\Http\Request;
use Dsone\Events\User\Banned;
use Dsone\Events\User\UpdatedByAdmin;
use Dsone\Http\Controllers\Controller;
use Dsone\Http\Requests\User\UpdateDetailsRequest;
use Dsone\Repositories\User\UserRepository;
use Dsone\Support\Enum\UserStatus;
use Dsone\User;

/**
 * Class UserDetailsController
 * @package Dsone\Http\Controllers\Users
 */
class DetailsController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Updates user details.
     *
     * @param User $user
     * @param UpdateDetailsRequest $request
     * @return mixed
     */
    public function update(User $user, UpdateDetailsRequest $request)
    {
        $data = $request->all();

        if (! data_get($data, 'country_id')) {
            $data['country_id'] = null;
        }

        $this->users->update($user->id, $data);
        $this->users->setRole($user->id, $request->role_id);

        event(new UpdatedByAdmin($user));

        // If user status was updated to "Banned",
        // fire the appropriate event.
        if ($this->userWasBanned($user, $request)) {
            event(new Banned($user));
        }

        return redirect()->back()
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Check if user is banned during last update.
     *
     * @param User $user
     * @param Request $request
     * @return bool
     */
    private function userWasBanned(User $user, Request $request)
    {
        return $user->status != $request->status
            && $request->status == UserStatus::BANNED;
    }
}
