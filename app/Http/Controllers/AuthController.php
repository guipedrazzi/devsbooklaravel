<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api',[
            'except' =>[
                'login',
                'create',
                'unauthorized'
            ]
        ]);
    }

    public function unauthorized()
    {
        return response()->json(['error' => 'Não autorizado.'],401);
    }

    public function create(Request $request)
    {
        //*POST -> api/user [add] (name, email, password, birthdate)
        $array = ['error' => ''];

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $birthdate = $request->input('birthdate');

        if($name && $email && $password && $birthdate){
            //Validando data de nascimento
            if(strtotime($birthdate) === false){
                $array['error'] = 'Data de nascimento inválida';
                return $array;
            }

            //Verificar existencia do e-mail
            $emailExists = User::where('email', $email)->count();
            if($emailExists === 0){

                $hash = password_hash($password, PASSWORD_DEFAULT);

                $newUser = new User();
                $newUser->name = $name;
                $newUser->email = $email;
                $newUser->password = $hash;
                $newUser->birthdate = $birthdate;
                $newUser->save();

                $token = auth()->attempt([
                    'email' => $email,
                    'password' => $password,
                ]);
                if(!$token){
                    $array['error'] = 'Erro ocorrido inexperado.';
                    return $array;
                }

                $array['token'] = $token;

            }else{
                $array['error'] = 'E-mail já cadastrado.';
                return $array;
            }

        }else{
            $array['error'] = 'Não enviou todos os campos.';
            return $array;
        }

        return $array;
    }

    public function login(Request $request){
        $array = ['error' => ''];

        $email = $request->input('email');
        $password = $request->input('password');

        if($email && $password){
            $token = auth()->attempt([
                'email' => $email,
                'password' => $password,
            ]);
            if(!$token){
                $array['error'] = 'E-mail e/ou senha errados!';
                return $array;
            }
            $array['token'] = $token;
        }else{
            $array['error'] = 'E-mail ou senha não digitados!';
        }


        return $array;
    }

    public function logout()
    {
        auth()->logout();
        return ['error'=>''];
    }

    public function refresh()
    {
        $token = auth()->refresh();
        return ['error'=>'','token' => $token];
    }


}
