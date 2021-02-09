<?php

namespace App\Http\Controllers;


use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionsController extends Controller
{

    public function store(Request $request){
        $userror = [
            'email'=>'required|email|unique:subscriptions'
        ];
        $ruerror = [
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'email.unique'=>'Такой Email уже существует',
        ];
        $validator = Validator::make($request->all(),$userror,$ruerror)->validate();

        Subscriptions::query()->create([
            'email'=>$request->email,
        ]);
        session()->flash('success','Вы подписались на обновления');

        return redirect()->home();
    }


}
