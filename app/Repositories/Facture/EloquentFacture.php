<?php

namespace Dsone\Repositories\Facture;

use Dsone\Facture;
use Carbon\Carbon;
use Dsone\Http\Filters\FactureKeywordSearch;

class EloquentFacture implements FactureRepository
{

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Facture::find($id);
    }


    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return Facture::create($data);
    }


    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Facture::query();

        if ($search) {
            (new FactureKeywordSearch)($query, $search);
        }

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }



        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {

        $client = $this->find($id);

        $client->update($data);

        return $client;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $client = $this->find($id);

        return $client->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return Facture::count();
    }

    /**
     * {@inheritdoc}
     */
    public function newFacturesCount()
    {
        return Facture::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])
            ->count();
    }



    /**
     * {@inheritdoc}
     */
    public function latest($count = 20)
    {
        return Facture::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function countOfNewFacturesPerMonth(Carbon $from, Carbon $to)
    {
        $result = Facture::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($client) {
                return $client->created_at->format("Y_n");
            });

        $counts = [];

        while ($from->lt($to)) {
            $key = $from->format("Y_n");

            $counts[$this->parseDate($key)] = count($result->get($key, []));

            $from->addMonth();
        }

        return $counts;
    }

    /**
     * Parse date from "Y_m" format to "{Month Name} {Year}" format.
     * @param $yearMonth
     * @return string
     */
    private function parseDate($yearMonth)
    {
        list($year, $month) = explode("_", $yearMonth);

        $month = trans("app.months.{$month}");

        return "{$month} {$year}";
    }

    /**
     * @return mixed|void
     */
    public function createReference()
    {
        return str_pad($this->getNextID(),10,STR_PAD_RIGHT);
    }




    /**
     * @inheritDoc
     */
    public function getShippingTotal($request)
    {
        return $request->shipping_cost;
    }

    /**
     * @inheritDoc
     */
    public function calculateTotalTTC($request)
    {
        if($request->has('prix_unitaire')) {
            return $request->prix_unitaire + $this->getShippingTotal($request);
        }
        return $this->getShippingTotal($request);
    }

    /**
     * @inheritDoc
     */
    public function calculateSurFacture($request): int
    {
        if($request->has('sur_facture')){
            return $request->sur_facture;
        }
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function calculateNetAmount($request): int
    {
        return $this->calculateTotalTTC($request) + $this->calculateSurFacture($request);
    }


    /**
     * @return mixed
     */
    public function getNextID()
    {
        $facture = new Facture();
        return $facture->getNextId();
    }
}
