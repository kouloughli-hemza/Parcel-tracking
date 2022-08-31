<?php

namespace Dsone\Repositories\Expediteur;

use Dsone\Expediteur;
use Carbon\Carbon;
use Dsone\Http\Filters\ExpediteurKeywordSearch;

class EloquentExpediteur implements ExpediteurRepository
{

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Expediteur::find($id);
    }


    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return Expediteur::create($data);
    }


    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Expediteur::query();

        if ($search) {
            (new ExpediteurKeywordSearch)($query, $search);
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
        return Expediteur::count();
    }

    /**
     * {@inheritdoc}
     */
    public function newExpediteursCount()
    {
        return Expediteur::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])
            ->count();
    }



    /**
     * {@inheritdoc}
     */
    public function latest($count = 20)
    {
        return Expediteur::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function countOfNewExpediteursPerMonth(Carbon $from, Carbon $to)
    {
        $result = Expediteur::whereBetween('created_at', [$from, $to])
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
}
