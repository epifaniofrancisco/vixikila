<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

use App\Api\ApiMessages;


class MobileController extends Controller
{
        public function authenticate_bkp(Request $request)
        {
                // dd($request);
                $credentials = $request->only('email', 'password');

                try {
                        if (!$token = JWTAuth::attempt($credentials)) {
                                return response()->json(['error' => 'invalid_credentials'], 400);
                        }
                } catch (JWTException $e) {
                        return response()->json(['error' => 'could_not_create_token'], 500);
                }

                return response()->json(compact('token'));
        }


        public function authenticate(Request $request)
        {
                $validator = Validator::make($request->all(), [
                        'email' => 'required|email',
                        'password' => 'required|string|min:1',
                ]);

                $credenciais = $request->only(['email', 'password']);

                try {
                        if (!$token = JWTAuth::attempt($credenciais)) {
                                return response()->json(['error' => 'invalid_credentials'], 400);
                        }
                } catch (JWTException $e) {
                        return response()->json(['error' => 'could_not_create_token'], 500);
                }

                // dd($token);

                // if ($validator->fails()) {
                //     return response()->json($validator->errors(), 422);
                // }

                // if (! $token = auth()->attempt($credenciais)) {
                //     return response()->json(['error' => 'Unauthorized'], 401);
                // }
                // if (!$token = auth()->attempt($credenciais)) {
                //         $message = new ApiMessages('Usuário não autorizado');
                //         return response()->json($message->getMessage());
                //         // return response()->json(['error' => 'Unauthorized'], 401);
                // }

                // return response()->json(['error' => 'Unauthorized'], 401);
                // else{

                        // dd($token);
                return $this->createNewToken($token);
                // }


        }

        public function register(Request $request)
        {
                $validator = Validator::make($request->all(), [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:6|confirmed',
                ]);

                if ($validator->fails()) {
                        return response()->json($validator->errors()->toJson(), 400);
                }

                $user = User::create([
                        'name' => $request->get('name'),
                        'email' => $request->get('email'),
                        'password' => Hash::make($request->get('password')),
                ]);

                $token = JWTAuth::fromUser($user);

                return response()->json(compact('user', 'token'), 201);
        }

        // public function getAuthenticatedUser()
        // {
        //         try {

        //                 if (!$user = JWTAuth::parseToken()->authenticate()) {
        //                         return response()->json(['user_not_found'], 404);
        //                 }
        //         } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        //                 return response()->json(['Token Espirado'], $e->getStatusCode());
        //         } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        //                 return response()->json(['Acesso Negado'], $e->getStatusCode());
        //         } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

        //                 return response()->json(['token_absent'], $e->getStatusCode());
        //         }

        //         return response()->json(compact('user'));
        // }

        protected function createNewToken($token)
        {

                // dd($token);
                return response()->json([
                        // 'access_token' => $token,
                        'status' => 200,
                        'token' => $token,
                        'token_type' => 'bearer',
                        // 'expires_in' => auth()->factory()->getTTL() * 60,
                        'user' => auth()->user()['name'],
                        'email' => auth()->user()['email'],
                        'cod' => auth()->user()['id'],
                        'it_codigo' => auth()->id(),
                        'perfil' => auth()->user()['vc_perfil']
                ]);
        }
}
