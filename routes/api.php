<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PostsController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


//admin apis

Route::prefix('admin')->group(function () {
         
          //login route
          Route::post('/login',[AdminController::class,'login']);
         
          //protected routes
         
               Route::middleware(['auth:sanctum','abilities:admin'])->group(function () {
                    Route::post('logout',[AdminController::class,'logout']);
                    //create post route
                     Route::post('/post/create',[PostsController::class,'create']);
                     Route::post('/post/fetch',[PostsController::class,'fetch']);
                     Route::put('/post/update/{id}', [PostsController::class,'update']);
                     Route::delete('/post/delete/{id}', [PostsController::class,'delete']);
      
                });
       
           
          


});


//user apis

Route::prefix('user')->group(function () {
    
     //login route
     Route::post('/login',[UserController::class,'login']);

});