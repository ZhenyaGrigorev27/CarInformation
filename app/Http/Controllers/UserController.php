<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(){
        return view('user.create');
    }


    public function store(Request $request){
        $userror = [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'avatar'=>'nullable|image'
        ];
        $ruerror = [
            'name.required'=>'Заполните ваше Имя',
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'email.unique'=>'Такой Email уже существует',
            'password.required'=>'Заполните поле пароля',
            'password.confirmed'=>'Пароли не совпадают',
            'avatar.image'=>'Выбран неподходящий формат'
        ];
        if ($request->hasFile('avatar')){
            $folder = date('Y-m-d');
            $avatar = $request->file('avatar')->store("images/{$folder}");
        }
        $validator = Validator::make($request->all(),$userror,$ruerror)->validate();

        $user = User::query()->create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password),
           'avatar'=>$avatar ?? null
        ]);

        session()->flash('success','Регистрация пройдена');
        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm(){
        return view('user.login');
    }

    public function login(Request $request){
        $userror = [
            'email'=>'required|email',
            'password'=>'required'
        ];
        $ruerror = [
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'password.required'=>'Заполните поле пароля',
        ];
        Validator::make($request->all(),$userror,$ruerror)->validate();

        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ])){
            session()->flash('successAuth', 'Вы успешно авторизовализись');
            if (Auth::user()->is_admin){
                return redirect()->route('admin.index');
            }
            else{
                return redirect()->home();
            }
        }
        return redirect()->back()->with('error','Некорректные данные');
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('login.create');
    }

    public function update(Request $request, $id)
    {
        $userror = [
            'email'=>'required|email',
            'password'=>'required'
        ];
        $ruerror = [
            'email.required'=>'Заполните поле Email',
            'email.email'=>'Email не соответствует стандарту example@example.com',
            'password.required'=>'Заполните поле пароля',
        ];
        Validator::make($request->all(),$userror,$ruerror)->validate();

        $post = Post::query()->find($id);
        $data = $request->all();
        if ($file = Post::uploadImage($request, $post->thumbnail)){
            $data['thumbnail'] = $file;
        }

        $post->update($data);
        $post->tags()->sync($request->tags);

        $request->session()->flash('success','Изменения сохранены');
        return redirect()->route('posts.index');
    }
}
