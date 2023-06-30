<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CarTest extends TestCase
{

    /**
     * test_car_create
     *
     * @return void
     */
    public function test_car_create()
    {
        $data = [
            'brand' => $this->faker->text,
            'type' => $this->faker->text,
            'weight' => $this->faker->numberBetween(0, 9999),
            'performance' => $this->faker->numberBetween(0, 9999),
            'production_date' => $this->faker->date('Y-m-d'),
        ];

        $this->postJson(self::ROUTE . 'car-create', $data)->assertStatus(302);

        $this->assertDatabaseHas('cars', [
            'brand' => $data['brand'],
            'type' => $data['type'],
            'weight' => $data['weight'],
            'performance' => $data['performance'],
            'production_date' => $data['production_date']
        ]);
    }

    /**
     * test_car_create_invalid
     *
     * @return void
     */
    public function test_car_create_invalid()
    {
        $data = [
            'brand' => $this->faker->text,
            'type' => $this->faker->text,
            'weight' => $this->faker->numberBetween(0, 9999),
            'performance' => $this->faker->text,
            'production_date' => $this->faker->date('Y-m-d'),
        ];

        $response = $this->postJson(self::ROUTE . 'car-create', $data)->assertStatus(422);

        $this->assertSame(
            'The performance field must be a number.',
            $response->getData()->errors->performance[0]
        );
    }

    /**
     * test_car_update
     *
     * @return void
     */
    public function test_car_update()
    {
        $data = [
            'brand' => $this->faker->text,
            'type' => $this->faker->text,
            'weight' => $this->faker->numberBetween(0, 9999),
            'performance' => $this->faker->numberBetween(0, 9999),
            'production_date' => $this->faker->date('Y-m-d'),
        ];

        $car = $this->car();

        $this->putJson(self::ROUTE . 'car/' . $car->id, $data)->assertStatus(302);

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'brand' => $data['brand'],
            'type' => $data['type'],
            'weight' => $data['weight'],
            'performance' => $data['performance'],
            'production_date' => $data['production_date']
        ]);
    }

    /**
     * test_car_update_invalid
     *
     * @return void
     */
    public function test_car_update_invalid()
    {
        $data = [
            'brand' => $this->faker->text,
            'type' => $this->faker->text,
            'weight' => $this->faker->numberBetween(0, 9999),
            'performance' => $this->faker->text,
            'production_date' => $this->faker->date('Y-m-d'),
        ];

        $car = $this->car();

        $response = $this->putJson(self::ROUTE . 'car/' . $car->id, $data)->assertStatus(422);

        $this->assertSame(
            'The performance field must be a number.',
            $response->getData()->errors->performance[0]
        );
    }

    /**
     * test_car_image_upload
     *
     * @return void
     */
    public function test_car_image_upload()
    {
        $car = $this->car();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->post(self::ROUTE . 'upload-image/' . $car->id, [
            'image' => $file
        ]);

        Storage::disk('public')->assertExists($car->image);
    }

    /**
     * test_car_image_upload
     *
     * @return void
     */
    public function test_car_image_delete()
    {
        $car = $this->car();

        $this->post(self::ROUTE . 'delete-image/' . $car->id);

        Storage::disk('public')->assertMissing($car->image);
    }

    /**
     * test_car_delete
     *
     * @return void
     */
    public function test_car_delete()
    {
        $car = $this->car();

        $car->forceDelete();

        $this->assertModelMissing($car);
    }
}
