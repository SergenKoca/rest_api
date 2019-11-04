<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserStateModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $token =  $user->createToken('MyApp')-> accessToken;

            // user state tablosunda durumu güncelle
            $userState = UserStateModel::where('user_id',$user->id)->first();
            if($userState !=null){
                $userState->is_online = true;
                $userState->is_writing = false;
                $userState->save();
            }
            else{
                $userState = new UserStateModel();
                $userState->user_id = $user->id;
                $userState->is_online = true;
                $userState->is_writing = false;
                $userState->save();
            }


            return response()->json([
                'token' => $token,
                'user'=>$user
            ], $this-> successStatus);
        }
        else{
            return response()->json([
                'error'=>'Unauthorised'
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()
            ], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token=$user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json([
            'token'=>$token
        ], $this-> successStatus);
    }

    public function logOut(){
        $user = Auth::user();

        // user state tablosunda durumu güncelle
        $userState = UserStateModel::where('user_id',$user->id);
        $userState->is_online = false;
        $userState->is_writing = false;
        $userState->save();

        $user->token()->revoke();
        $user->token()->delete();

        return response()->json([
            'message'=>'logout ok'
        ]);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json([
            'success' => $user
        ], $this-> successStatus);
    }

}
