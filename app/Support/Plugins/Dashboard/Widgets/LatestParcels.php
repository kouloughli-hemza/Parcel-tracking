<?php

namespace Dsone\Support\Plugins\Dashboard\Widgets;

use Dsone\Repositories\Coli\ColiRepository;
use Vanguard\Plugins\Widget;

class LatestParcels extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '6';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'users.manage';

    /**
     * @var ColiRepository
     */
    private $parcels;

    /**
     * LatestParcels constructor.
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
        return view('plugins.dashboard.widgets.latest-parcels', [
            'latestParcels' => $this->parcels->latest(6)
        ]);
    }
}
