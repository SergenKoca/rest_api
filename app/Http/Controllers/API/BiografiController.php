<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Api\BiographyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BiografiController extends Controller
{
    public function create(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'biography_content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()
            ], 401);
        }

        $biography = new BiographyModel();
        $biography->user_id = $user->id;
        $biography->biography_content = $request->biography_content;
        $biography->save();
        return response()->json([
            'message'=>"biography created"
        ],200);
    }

    public function getBiography(){
        $user = Auth::user();
        if($user!=null){
            $biyografi = BiographyModel::where('user_id',$user->id)->first();
            if($biyografi!=null){
                return response()->json([
                    'id'=>$user->id,
                    'biyografi'=> $biyografi->biography_content
                ]);
            }
            else{
                return response()->json([
                    'user'=>$user->id,
                    'biyografi'=>"biyografi bulunmamaktadır"
                ]);
            }
        }
        else{
            return response()->json([
                'error'=>'Unauthorised'
            ], 401);
        }
    }

    public function editBiography(Request $request){
        $user = Auth::user();
        if($user!=null){
            $validator = Validator::make($request->all(),[
                'biography_content' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error'=>$validator->errors()
                ], 401);
            }
            $biografi = BiographyModel::where('user_id',$user->id)->first();
            $biografi->biography_content = $request->biography_content;
            $biografi->save();
            return response()->json([
                'user'=>$user,
                'success'=>'biography updated'
            ], 200);
        }
        else{
            return response()->json([
                'error'=>'Unauthorised'
            ], 401);
        }
    }

    public function delete(){
        $user = Auth::user();
        if($user!=null){
            $biyografi = BiographyModel::where('user_id',$user->id)->first();
            if($biyografi!=null){
                $biyografi->delete();
                return response()->json([
                     'user'=>$user,
                     'message'=>'biography was deleted'
                ]);
            }
            return response()->json([
                'message'=>'no biography so you have create new biography'
            ]);
        }
        else{
            return response()->json([
                'error'=>'Unauthorised'
            ], 401);
        }
    }
}
