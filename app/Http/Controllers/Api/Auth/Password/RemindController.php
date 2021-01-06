<?php

namespace Dsone\Http\Controllers\Api\Auth\Password;

use Password;
use Dsone\Events\User\RequestedPasswordResetEmail;
use Dsone\Http\Controllers\Api\ApiController;
use Dsone\Http\Requests\Auth\PasswordRemindRequest;
use Dsone\Mail\ResetPassword;
use Dsone\Repositories\User\UserRepository;

class RemindController extends ApiController
{
    /**
     * Send a reset link to the given user.
     *
     * @param PasswordRemindRequest $request
     * @param UserRepository $users
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PasswordRemindRequest $request, UserRepository $users)
    {
        $user = $users->findByEmail($request->email);

        $token = Password::getRepository()->create($user);

        \Mail::to($user)->send(new ResetPassword($token));

        event(new RequestedPasswordResetEmail($user));

        return $this->respondWithSuccess();
    }
}
