<?php

namespace Dsone\Http\Controllers\Api;

use Dsone\Http\Resources\CountryResource;
use Dsone\Repositories\Country\CountryRepository;

/**
 * @package Dsone\Http\Controllers\Api
 */
class CountriesController extends ApiController
{
    /**
     * @var CountryRepository
     */
    private $countries;

    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Get list of all available countries.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CountryResource::collection($this->countries->all());
    }
}
