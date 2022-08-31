<?php

namespace Dsone\Repositories\Coli;

use Dsone\Coli;
use Carbon\Carbon;
use Dsone\Http\Filters\ColiKeywordSearch;

class EloquentColi implements ColiRepository
{

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Coli::find($id);
    }


    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return Coli::create($data);
    }


    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Coli::query();

        if ($search) {
            (new ColiKeywordSearch)($query, $search);
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

        $coli = $this->find($id);

        $coli->update($data);

        return $coli;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $coli = $this->find($id);

        return $coli->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return Coli::count();
    }

    /**
     * {@inheritdoc}
     */
    public function newColisCount()
    {
        return Coli::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])
            ->count();
    }



    /**
     * {@inheritdoc}
     */
    public function latest($count = 20)
    {
        return Coli::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function countOfNewColisPerMonth(Carbon $from, Carbon $to)
    {
        $result = Coli::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($coli) {
                return $coli->created_at->format("Y_n");
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
     * @inheritDoc
     */
    public function generateTrackingNumber(): string
    {
        $prefix = "ECNRKM";
        $randomNumber = $this->randomNumber(13);
        return $prefix . $randomNumber . $this->getNextID();

    }


    /**
     * @return mixed
     */
    public function getNextID()
    {
        $coli = new Coli();
        return $coli->getNextId();
    }


    private function randomNumber($limit){
        $code = 0;
        for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
        return $code;
    }
}
