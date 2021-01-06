<?php

namespace Dsone\Listeners\Registration;

use Illuminate\Auth\Events\Registered;
use Mail;
use Dsone\Repositories\User\UserRepository;

class SendSignUpNotification
{
    /**
     * @var UserRepository
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        if (! setting('notifications_signup_email')) {
            return;
        }

        foreach ($this->users->getUsersWithRole('Admin') as $user) {
            Mail::to($user)->send(new \Dsone\Mail\UserRegistered($event->user));
        }
    }
}
