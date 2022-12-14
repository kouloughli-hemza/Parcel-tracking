<?php

namespace Dsone\Http\Controllers\Api;

use Dsone\Http\Resources\SessionResource;
use Dsone\Repositories\Session\SessionRepository;

/**
 * Class SessionsController
 * @package Dsone\Http\Controllers\Api\Users
 */
class SessionsController extends ApiController
{
    /**
     * @var SessionRepository
     */
    private $sessions;

    public function __construct(SessionRepository $sessions)
    {
        $this->middleware('session.database');
        $this->sessions = $sessions;
    }

    /**
     * Get info about specified session.
     * @param $session
     * @return SessionResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($session)
    {
        $this->authorize('manage-session', $session);

        return new SessionResource($session);
    }

    /**
     * Destroy specified session.
     * @param $session
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($session)
    {
        $this->authorize('manage-session', $session);

        $this->sessions->invalidateSession($session->id);

        return $this->respondWithSuccess();
    }
}
