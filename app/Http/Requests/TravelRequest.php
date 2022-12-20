<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class TravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'class' => 'integer|nullable',
            'model' => 'string|nullable',
            'start'  => 'required|date',
            'end'  => 'required|date'
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $class = $this->get('class');
            $model = $this->get('model');

            if($class>Auth::user()->class_level){
                $validator->errors()->add('class', "Класс автомобиля не может быть выше допустимого в вашей должности");
            }

            if($model){
            $modelCar = Car::pluck('model');
                    if(array_search(strtolower($model), json_decode(strtolower($modelCar), true)) === false)
                    {
                        $validator->errors()->add('model', "Такой модели нет в нашем автопарке");

                    }
                }



        });
    }
}
