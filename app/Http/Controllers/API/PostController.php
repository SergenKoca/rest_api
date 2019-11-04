<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PostsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'img_url' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()
            ], 401);
        }

        $post = new PostsModel();
        $post->user_id = $user->id;
        $post->tag = $request->tag;
        $post->post_comment = $request->post_comment;
        if($request->hasFile('img_url')){
            $file=$request->file('img_url');
            $file->move(public_path() . '/images/news',$file->getClientOriginalName());
            $post->img_url=$file->getClientOriginalName();
        }
        $post->save();

        return response()->json([
           'message'=>'post created',
           'user'=>$user
        ]);
    }
    public function getPosts(){
        $user = Auth::user();
        if($user!=null){
            $posts = PostsModel::where('user_id',$user->id)->get();
            if($posts!=null){
                return response()->json([
                    'posts'=>$posts,
                    'user'=>$user
                ]);
            }
            return response()->json([
                'message'=>'you have no posts',
                'user'=>$user
            ]);
        }
        return response()->json([
            'error'=>'Unauthorised'
        ], 401);
    }
    public function getPost(Request $request){
        $user = Auth::user();
        if($user!=null){
            $post = PostsModel::find($request->id);
            if($post!=null){
                return response()->json([
                   'post'=>$post,
                   'user'=>$user
                ]);
            }
            return response()->json([
                'message'=>'you have no post as this id '.$request->id,
                'user'=>$user
            ]);
        }
        return response()->json([
            'error'=>'Unauthorised'
        ], 401);
    }

    public function updatePost(Request $request){
        $user = Auth::user();
        $post = PostsModel::find($request->id);
        $post->user_id = $user->id;
        $post->tag = $request->tag;
        $post->post_comment = $request->post_comment;
        if($request->hasFile('img_url')){
            $file=$request->file('img_url');
            $file->move(public_path() . '/images/news',$file->getClientOriginalName());
            $post->img_url=$file->getClientOriginalName();
        }
        $post->save();

        return response()->json([
            'message'=>'post was updated',
            'user'=>$user
        ]);
    }

    public function delete(Request $request){
        $user = Auth::user();
        if($user!=null){
            $post = PostsModel::find($request->id);
            if($post!=null){
                 $post->delete();
                return response()->json([
                    'message'=>'post was deleted',
                    'user'=>$user
                ]);
            }
            return response()->json([
                'message'=>'you have no post with this id '.$request->id,
                'user'=>$user
            ]);
        }
        return response()->json([
            'error'=>'Unauthorised'
        ], 401);
    }
}
