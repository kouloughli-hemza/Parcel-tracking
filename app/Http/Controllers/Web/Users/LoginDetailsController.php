<?php

namespace Dsone\Http\Controllers\Web\Users;

use Dsone\Events\User\UpdatedByAdmin;
use Dsone\Http\Controllers\Controller;
use Dsone\Http\Requests\User\UpdateLoginDetailsRequest;
use Dsone\Repositories\User\UserRepository;
use Dsone\User;

/**
 * Class UserDetailsController
 * @package Dsone\Http\Controllers\Users
 */
class LoginDetailsController extends Controller
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
     * Update user's login details.
     *
     * @param User $user
     * @param UpdateLoginDetailsRequest $request
     * @return mixed
     */
    public function update(User $user, UpdateLoginDetailsRequest $request)
    {
        $data = $request->all();

        if (! $data['password']) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update($user->id, $data);

        event(new UpdatedByAdmin($user));

        return redirect()->route('users.edit', $user->id)
            ->withSuccess(__('Login details updated successfully.'));
    }
}
