<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Car;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    protected const ROUTE = '/api/v1/';
    /**
     * user
     *
     * @return Car
     */
    protected function car(): Car
    {
        return Car::latest('id')->first();
    }
}
