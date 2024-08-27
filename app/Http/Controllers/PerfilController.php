<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username'=> Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users', 'min:3', 'max:20', 'not_in:twitter,editar-perfil']
        ]);

        if ($request->imagen) {
            $manager = new ImageManager(new Driver());

            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = $manager->read($imagen);
            $imagenServidor->resize(1000, 1000);

            //agregamos la imagen a la  carpeta en public donde se guardaran las imagenes
            $imagenesPath = public_path('perfiles') . '/' . $nombreImagen;

            //Una vez procesada la imagen entonces guardamos la imagen en la carpeta que creamos
            $imagenServidor->save($imagenesPath);
        }

        //guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email ?? auth()->user()->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        //redireccionar
        return redirect()->route('post.index', $usuario->username);
    }
}
