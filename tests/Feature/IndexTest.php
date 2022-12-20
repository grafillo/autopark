<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Car;
use App\Models\Employee;
use App\Models\Travel;
use Carbon\Carbon;
use Tests\TestCase;

class IndexTest extends TestCase
{

    private function getToken(){

        $emp = Employee::factory()->create(['class_level' => 2]);
        $id = ['id' => $emp->id];
        $token = $this->json('get', "/api/gettoken",
            $id)->content();

        return ['Authorization' => "Bearer $token"];

    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_token()
    {
        $emp = Employee::factory()->create();
        $data = ['id' => $emp->id];

        $response = $this->json('get', "/api/gettoken",
            $data);

        $response->assertOk();
    }


    public function test_set_wrong_class()
    {

        $data = [
            'from' => Carbon::now()->toDateTimeString(),
            'till' => Carbon::now()->toDateTimeString(),
            'class' => 3
        ];


        $response = $this->json('get', "/api/getfreecars",
            $data, $this->getToken());


       $response->assertStatus(422);
    }

    public function test_set_wrong_car()
    {

        $data = [
            'from' => Carbon::now()->toDateTimeString(),
            'till' => Carbon::now()->toDateTimeString(),
            'model' => 'hyndai'
        ];


        $response = $this->json('get', "/api/getfreecars",
            $data, $this->getToken());


        $response->assertStatus(422);
    }


    public function test_give_free_car()
    {
        $emp = Travel::factory()->create([
            'start' =>  Carbon::create(2022, 12, 1, 12, 00, 00),
            'end' => Carbon::create(2022, 12, 1, 13, 00, 00),
            'car_id' => 4,
            'employeer_id' => 6
            ]);


        $data = [
            'from' => Carbon::create(2022, 12, 1, 12, 00, 00),
            'till' => Carbon::now()->toDateTimeString(),
        ];

        $car = Car::whereNotIn('id',[4])->where('class','<=',2)->get();


        $response = $this->json('get', "/api/getfreecars",
            $data, $this->getToken());

        $response->assertJson($car->toArray());

    }

}
