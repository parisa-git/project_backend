<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\userRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{

    /**
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){

        $request->validate([
            "name"=>['required'],
            "email"=>['required','email','unique:users'],
            "password"=>['required']
        ]);

    resolve(userRepository::class)->create($request);


        return response()->json([
        'message'=> 'create sucsessfully'
    ],201);

    }

    /**
     *
     * @method GET
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([

            "email"=>['required','email'],
            "password"=>['required']
        ]);
        if(Auth::attempt($request->only(['email','password']))){
            return response()->json(Auth::user(),200);
        }

        throw ValidationException::withMessage([
            'email'=>'incorrect email'
        ]);
    }


    public function user()
    {
        return response()->json(Auth::user(),200);
    }

    public function logout(){

        Auth::logout();
        return response()->json([
            'message'=>'logout successfully'
        ],200);
    }



}
