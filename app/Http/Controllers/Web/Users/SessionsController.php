<?php

namespace Dsone\Http\Controllers\Web\Users;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Dsone\Http\Controllers\Controller;
use Dsone\Repositories\Session\SessionRepository;
use Dsone\User;

/**
 * Class SessionsController
 * @package Dsone\Http\Controllers\Web\Users
 */
class SessionsController extends Controller
{
    /**
     * @var SessionRepository
     */
    private $sessions;

    /**
     * SessionsController constructor.
     * @param SessionRepository $sessions
     */
    public function __construct(SessionRepository $sessions)
    {
        $this->middleware('permission:users.manage');

        $this->sessions = $sessions;
    }

    /**
     * Displays the list with all active sessions for the selected user.
     *
     * @param User $user
     * @return Factory|View
     */
    public function index(User $user)
    {
        return view('user.sessions', [
            'adminView' => true,
            'user' => $user,
            'sessions' => $this->sessions->getUserSessions($user->id)
        ]);
    }

    /**
     * Invalidate specified session for selected user.
     *
     * @param User $user
     * @param $session
     * @return mixed
     */
    public function destroy(User $user, $session)
    {
        $this->sessions->invalidateSession($session->id);

        return redirect()->route('users.sessions', $user->id)
            ->withSuccess(__('Session invalidated successfully.'));
    }
}
