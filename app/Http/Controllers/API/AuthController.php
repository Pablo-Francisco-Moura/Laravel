<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notification\PasswordReset;

class AuthController extends BaseController
{
    public function signin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users',
            'password' => 'required|string|min:8'
        ]);
        if($validator->fails()){
            return $this->sendError('Error de validação', $validator->errors(), 400);
        }

        //attempt verifica se pode autenticar com email e senha passados
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
           $user = Auth::user();

           //now() gera novo token
           $token = $user->createToken($user->email . '-' . now());
           return $this->sedResponse(['token' => $token->accessToken]);
        }else{
            return $this->sendError('Email ou Senha inválidos', [], 404);

        }
    }

    public function reset(Request $request){
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user= User::where('email', $request->email)->first();

        if(!$user){
            return response()->json([
                'message' => 'Não encontramos nenhum email com esse endereço',
            ], 404);
        }

        $token = app('auth.password.broker')->createToken($user);

        DB::table(config('auth.passwords.users.table'))->insert([
            'email' => $user->email,
            'token' => $token,
        ]);

        $user->notify(
            new PasswordRequest($token)
        );
        
        return response()->json([
            'message' => 'Nós enviamos um email de recuperação no email cadastrado.',
        ]);
    }

}
