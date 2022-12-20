<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRequest;
use App\Http\Requests\TravelRequest;
use App\Models\Car;
use App\Models\Employee;
use App\Models\Travel;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function view (TravelRequest $request){

        if(!$request->class){
            $class =  Auth::user()->class_level;
        }else {
            $class = $request->class;
        }

        $cars = Travel::where('start', '<=',$request->start)->where('end', '>=',$request->start)
            ->orWhere('start', '<=',$request->end)->where('end','>=',$request->end)->pluck('car_id');

        $cars = Car::whereNotIn('id', $cars)->where('class','<=',$class);

        if($request->model){
            $cars = $cars->where('model',$request->model);
        }

        return $cars->get();

    }

    public function getToken (TokenRequest $request){

        $user = Employee::where('id', $request->id)->first();
        return $user->createToken($user->lastname)->plainTextToken;

    }



}
