<?php

namespace App\Http\Controllers;

use App\Models\Car;

class RouterController extends Controller
{

    /**
     * showCompanies
     *
     * @return mixed
     */
    public function showCars(): mixed
    {
        $cars = Car::all();

        return view('dashboard', compact('cars'));
    }

    /**
     * showCompanyDetails
     *
     * @param Car $car
     * @return mixed
     */
    public function showCarDetails(Car $car): mixed
    {
        return view('car.car_details', compact('car'));
    }

    /**
     * showCompanyCreate
     *
     * @return mixed
     */
    public function showCarCreate(): mixed
    {
        return view('car.create_or_edit_car');
    }

    /**
     * showCompanyEdit
     *
     * @param Car $car
     * @return mixed
     */
    public function showCarEdit(Car $car): mixed
    {
        return view('car.create_or_edit_car', compact('car'));
    }
}
