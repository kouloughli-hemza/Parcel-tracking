<?php

namespace Dsone\Http\Controllers\Web\Profile;

use Dsone\Events\User\UpdatedProfileDetails;
use Dsone\Http\Controllers\Controller;
use Dsone\Http\Requests\User\UpdateProfileDetailsRequest;
use Dsone\Repositories\User\UserRepository;

/**
 * Class DetailsController
 * @package Dsone\Http\Controllers
 */
class DetailsController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * DetailsController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Update profile details.
     *
     * @param UpdateProfileDetailsRequest $request
     * @return mixed
     */
    public function update(UpdateProfileDetailsRequest $request)
    {
        $this->users->update(auth()->id(), $request->except('role_id', 'status'));

        event(new UpdatedProfileDetails);

        return redirect()->back()
            ->withSuccess(__('Profile updated successfully.'));
    }
}
