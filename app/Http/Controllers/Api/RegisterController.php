<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Validation Error.', $validator->errors()], 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $data['token'] =  $user->createToken('OctoApp')->plainTextToken;
        $data['name'] =  $user->name;

        return response()->json([
            'message' => 'User register successfully',
            'success'=> true,
            'data' => $data
        ]);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $data['token'] =  $user->createToken('OctoApp')->plainTextToken;
            $data['name'] =  $user->name;

            return response()->json([
                'message' => 'User login successfully',
                'success'=> true,
                'data' => $data
            ]);
        }
        else{
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
}
