<?php

namespace Dsone\Http\Controllers\Api\Profile;

use Dsone\Http\Controllers\Api\ApiController;
use Dsone\Http\Resources\SessionResource;
use Dsone\Repositories\Session\SessionRepository;

/**
 * @package Dsone\Http\Controllers\Api\Profile
 */
class SessionsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('session.database');
    }

    /**
     * Handle user details request.
     * @param SessionRepository $sessions
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SessionRepository $sessions)
    {
        $sessions = $sessions->getUserSessions(auth()->id());

        return SessionResource::collection($sessions);
    }
}
