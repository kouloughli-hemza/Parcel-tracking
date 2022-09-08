<?php

namespace Dsone\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use Dsone\Repositories\Facture\FactureRepository;
use Vanguard\Plugins\Widget;
use Dsone\Repositories\User\UserRepository;

class FacturesHistory extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '6';

    /**
     * @var string
     */
    protected $permissions = 'users.manage';

    /**
     * @var UserRepository
     */
    private $factures;

    /**
     * @var array Count of new users per month.
     */
    protected $facturesPerMonth;

    /**
     * RegistrationHistory constructor.
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
        return view('plugins.dashboard.widgets.factures-history', [
            'facturesPerMonth' => $this->getFacturesPerMonth()
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function scripts()
    {
        return view('plugins.dashboard.widgets.factures-history-scripts', [
            'facturesPerMonth' => $this->getFacturesPerMonth()
        ]);
    }

    private function getFacturesPerMonth(): array
    {
        if ($this->facturesPerMonth) {
            return $this->facturesPerMonth;
        }

        return $this->facturesPerMonth = $this->factures->countOfNewFacturesPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );
    }
}
