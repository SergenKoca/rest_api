<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BiographyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BiographyController extends Controller
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
    public function getBiography(Request $request){

    }
}
