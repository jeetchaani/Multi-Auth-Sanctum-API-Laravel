<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function create(Request $request){
        //return auth()->user()->currentAccessToken()->tokenable_id;
        //return 1;
           if(auth()->user()->currentAccessToken()){
              $admin_id=auth()->user()->currentAccessToken()->tokenable_id;
                   //validate post
                   $validator=Validator::make($request->all(),[
                    'title'=>'required',
                    'description'=>'required'
                ]);
                    if($validator->fails()){
                        return $this->jsonResponse(false,$validator->errors(),422);
                    }
                    else{
                        $post=Post::create([
                            'user_id'=>$admin_id,
                            'title'=>$request->title,
                            'description'=>$request->description
                        ]);
                        return $this->jsonResponse(true,$post,200);
                    }
           }
    }
    public function update(Request $request, string $id){
        if(auth()->user()->currentAccessToken()){
            $admin_id=auth()->user()->currentAccessToken()->tokenable_id;

            //find post and check permisssion
              $post=Post::where('id','=',$id)
              ->where('user_id','=',$admin_id)
              ->first();
                if($post){
                     //validate
                     $validator=Validator::make($request->all(),[
                        'title'=>'required',
                        'description'=>'required'
                    ]);
                    if($validator->fails()){
                        return $this->jsonResponse(false,$validator->errors(),422);
                    }
                    else{
                         $post->update([
                            'title'=>$request->title,
                            'description'=>$request->description
                         ]);
                        return $this->jsonResponse(true,$post,200);
                    }

                }else{
                    return $this->jsonResponse(false,"Unauthorized",401);  
                }
        }

    }
    public function delete(string $id){
        if(auth()->user()->currentAccessToken()){
            $admin_id=auth()->user()->currentAccessToken()->tokenable_id;

            //find post and check permisssion
              $post=Post::where('id','=',$id)
              ->where('user_id','=',$admin_id)
              ->first();
                if($post){
                     //delete this post
                    
                     return Post::destroy($id);
                   

                }else{
                    return $this->jsonResponse(false,"Unauthorized",401);  
                }
        }
    }
    public function jsonResponse($status,$message,$status_code){
        return response()->json([
'status'=>$status,
'message'=>$message
],$status_code);
}
}
