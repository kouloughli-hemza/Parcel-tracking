<?php

namespace Dsone\Support\Plugins\Dashboard\Widgets;

use Dsone\Repositories\Coli\ColiRepository;
use Vanguard\Plugins\Widget;
use Dsone\Repositories\User\UserRepository;
use Dsone\Support\Enum\UserStatus;

class TotalParcels extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '3';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'users.manage';

    /**
     * @var UserRepository
     */
    private $parcels;

    /**
     * UnconfirmedUsers constructor.
     * @param ColiRepository $parcels
     */
    public function __construct(ColiRepository $parcels)
    {
        $this->parcels = $parcels;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.total-parcels', [
            'count' => $this->parcels->count()
        ]);
    }
}
