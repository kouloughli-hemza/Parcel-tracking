<?php

namespace Dsone\Http\Controllers\Api\Users;

use Dsone\Http\Controllers\Api\ApiController;
use Dsone\Http\Resources\SessionResource;
use Dsone\Repositories\Session\SessionRepository;
use Dsone\User;

/**
 * @package Dsone\Http\Controllers\Api\Users
 */
class SessionsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:users.manage');
        $this->middleware('session.database');
    }

    /**
     * Get sessions for specified user.
     * @param User $user
     * @param SessionRepository $sessions
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(User $user, SessionRepository $sessions)
    {
        return SessionResource::collection(
            $sessions->getUserSessions($user->id)
        );
    }
}
