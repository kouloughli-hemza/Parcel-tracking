<?php

namespace Dsone\Support\Plugins\Dashboard\Widgets;

use Dsone\Repositories\Facture\FactureRepository;
use Vanguard\Plugins\Widget;
use Dsone\Repositories\User\UserRepository;

class TotalFactures extends Widget
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
    private $factures;

    /**
     * UnconfirmedUsers constructor.
     * @param FactureRepository $factures
     */
    public function __construct(FactureRepository $factures)
    {
        $this->factures = $factures;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.total-factures', [
            'count' => $this->factures->count()
        ]);
    }
}
