<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    //
   public function funlistar(Request $request) {
    
    return User::get();
}
    public function funLogin(Request $request) {

    
           $credenciales=   $request->validate([
           
            "email"=>"required|email",
            "password"=>"required",
           
        ]);

       
        if (!Auth::attempt($credenciales))
        {
            return response()->json(["mensaje"=>"Credenciales no autorizadas"],401);
        }
        $token= $request->user()->createToken("Token Auth")->plainTextToken;

        return response()->json(["access_token"=>$token,"usuario"=>$request->user()]);
    }
    public function funRegister(Request $request) {
        $request->validate([
            "name"=>"required",
            "email"=>"required|unique:users|email",
            "password"=>"required",
            "cpassword"=>"required|same:password"
        ]);
        $usuario= new User();
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->password=Hash::make($request->password);
        $usuario->save();
        return response()->json(["mensaje"=>"Usuario Registrado"]);

    }


       public function funProfile(Request $request){
        return response()->json($request->user(), 200);
    }

    public function funLogout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(["mensaje" => "Salir"]);
    }
}
