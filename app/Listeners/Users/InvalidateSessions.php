<?php

namespace Dsone\Listeners\Users;

use Dsone\Events\User\Banned;
use Dsone\Repositories\Session\SessionRepository;

class InvalidateSessions
{
    /**
     * @var SessionRepository
     */
    private $sessions;

    public function __construct(SessionRepository $sessions)
    {
        $this->sessions = $sessions;
    }

    /**
     * Handle the event.
     *
     * @param Banned $event
     * @return void
     */
    public function handle(Banned $event)
    {
        $user = $event->getBannedUser();

        $this->sessions->invalidateAllSessionsForUser($user->id);
    }
}
