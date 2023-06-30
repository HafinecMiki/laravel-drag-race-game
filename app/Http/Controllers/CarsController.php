<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarCreateRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function startRace(Request $request): RedirectResponse
    {
        if (!$request->ids || count($request->ids) < 2 || count($request->ids) > 3) {
            return back()->with('error', 'Failed selected cars! Please select minimum 2, maximum 3 cars.');
        }

        $winnerCar = null;
        $maximum = 0;

        foreach ($request->ids as $id) {
            $car = Car::find($id);

            if (($car->performance / $car->weight) > $maximum) {
                $maximum = ($car->performance / $car->weight);
                $winnerCar = $car;
            }
        }

        return back()->with('winner', $winnerCar);
    }

    /**
     * create a new car
     *
     * @param CarCreateRequest $request
     * @return RedirectResponse
     */

    public function store(CarCreateRequest $request): RedirectResponse
    {
        Car::create($request->validated());

        return back()->with('success', 'Create company successfully');

    }


    /**
     * edit a car
     *
     * @param CarUpdateRequest $request
     * @param Car $car
     * @return RedirectResponse
     */
    public function update(CarUpdateRequest $request, Car $car): RedirectResponse
    {
        $data = $request->validated();

        $car->update($data);

        return back()->with('success', 'Update car successfully');
    }


    /**
     * delete a car
     *
     * @param Car $car
     * @return RedirectResponse
     */
    public function destroy(Car $car): RedirectResponse
    {
        $car->delete();

        return redirect('/');
    }
}
