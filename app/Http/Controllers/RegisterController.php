<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {


        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);
        // dd($request->get('username'));

        //modificar el request esto como ultima opcion
        $request->request->add(['username'=> Str::slug($request->username)]);

        //validacion
        $this->validate($request,[
            'name' => 'required|max:20',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        //en la version laravel 9 para hashear un password se utiliza la clase y el metodo Hash::make($password)
        // es decir 'password' => Hash::make($request->password)
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //funciones para autenticar
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));
        //redireccionar
        return redirect()->route('post.index');
    }

}
