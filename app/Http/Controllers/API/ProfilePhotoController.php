<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Api\ProfilePhotoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfilePhotoController extends Controller
{
    public function create(Request $request){
        $user = Auth::user();
        if($user!=null){

            $profilePhoto = new ProfilePhotoModel();
            $profilePhoto->user_id = $user->id;

            if($request->hasFile('img_url')){
                $file=$request->file('img_url');
                $file->move(public_path() . '/images/news',$file->getClientOriginalName());
                $profilePhoto->img_url=$file->getClientOriginalName();
            }
            $profilePhoto->save();

            return response()->json([
                'user'=>$user,
                'success'=>'profile photo created'
            ],200);
        }
        else{
            return response()->json([
                'error'=>'Unauthorised'
            ], 204);
        }
    }

    public function getPhoto(){
        $user = Auth::user();
        if($user!=null){
            $profilePhoto = ProfilePhotoModel::where('user_id',$user->id)->first();
            if($profilePhoto!=null){
                return response()->json([
                    'user'=>$user,
                    'img_url'=>$profilePhoto->img_url
                ],200);
            }
            return response()->json([
                'user'=>$user,
                'message'=>'no profile photo'
            ],200);
        }
        else{
            return response()->json([
                'error'=>'Unauthorised'
            ], 401);
        }
    }

    public function updatePhoto(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'img_url' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()
            ], 204);
        }
        if($user!=null){
            $profilePhoto = ProfilePhotoModel::where('user_id',$user->id)->first();
            if($profilePhoto!=null){
                if($request->hasFile('img_url')){
                    $file=$request->file('img_url');
                    $file->move(public_path() . '/images/news',$file->getClientOriginalName());
                    $profilePhoto->img_url=$file->getClientOriginalName();
                }
                $profilePhoto->save();

                return response()->json([
                    'user'=>$user,
                    'success'=>'profile photo updated'
                ],200);
            }

            return response()->json([
                'user'=>$user,
                'message'=>'no profile photo so you have create new profile photo'
            ],200);
        }
        else{
            return response()->json([
                'error'=>'Unauthorised'
            ], 401);
        }

    }

    public function deletePhoto(){
        $user = Auth::user();
        if($user!=null){
            $profilePhoto = ProfilePhotoModel::where('user_id',$user->id)->first();
            $profilePhoto->delete();

            return response()->json([
               'message'=>'profile photo deleted',
               'user'=>$user
            ],200);
        }
        else{
            return response()->json([
                'error'=>'Unauthorised'
            ],401);
        }
    }
}
