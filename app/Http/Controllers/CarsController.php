<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarCreateRequest;
use App\Http\Requests\CarImageUploadRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Http\Requests\RaceRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * @param RaceRequest $request
     * @return RedirectResponse
     */
    public function startRace(RaceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // winners data
        $winnerCar = null;
        $maximum = 0;

        foreach ($data['ids'] as $id) {
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
        $car = Car::create($request->validated());

        return redirect(route('car-edit-page', $car->id))->with('success', 'Create car successfully');

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

    /**
     * car image upload
     *
     * @param Car $car
     * @param CarImageUploadRequest $request
     * @return RedirectResponse
     */
    public function storeImage(Car $car, CarImageUploadRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $imageName = time().'.'.$data['image']->extension();

        // Public Folder
        $data['image']->move(public_path('images'), $imageName);

        //save
        $car->update([
            'image' => $imageName,
        ]);

        return back()->with('success', 'Image uploaded Successfully!')
            ->with('image', $imageName);
    }
}
