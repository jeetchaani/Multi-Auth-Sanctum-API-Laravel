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
                        return jsonResponse(false,$validator->errors(),422);
                    }
                    else{
                        $post=Post::create([
                            'user_id'=>$admin_id,
                            'title'=>$request->title,
                            'description'=>$request->description,
                            'status'=>'Y'
                        ]);
                        return jsonResponse(true,$post,200);
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
                        return jsonResponse(false,$validator->errors(),422);
                    }
                    else{
                         $post->update([
                            'title'=>$request->title,
                            'description'=>$request->description
                         ]);
                        return jsonResponse(true,$post,200);
                    }

                }else{
                    return jsonResponse(false,"Unauthorized",401);  
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
                    return jsonResponse(false,"Unauthorized",401);  
                }
        }
    }
   public function fetch(Request $request){
    if(auth()->user()->currentAccessToken()){
        $admin_id=auth()->user()->currentAccessToken()->tokenable_id;
           //get post of this user and apply paginate on every post 
           $records_per_page=1;  
           $result=Post::where('user_id','=',$admin_id)
           ->where('status','=','Y')
           ->skip($this->paginationCustom($request->page,$records_per_page))
           ->take($records_per_page)
           ->orderBy('id','desc')
           ->get();
           return jsonResponse(true,$result,200);

    }
   }  
    
public function paginationCustom($page=1,$records_per_page){
    return ($page-1)*$records_per_page;
}
}
