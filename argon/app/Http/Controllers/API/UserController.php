<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Egulias\EmailValidator\Result\Reason\EmptyReason;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function addUser(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'contact' => 'required',
                'profile_image' => 'required',

               ]);
               if($validator->fails()){
                   return response()->json(['success' => false,'message' => $validator->messages()] ,200);
               }
               $post = $request->all();
               if($request->has('profile_image')){
                 $image = $request->file('profile_image')->store('image/profileImage','public');
                 $post['profile_image'] = $image;
               }
               $user = User::create($post);
               if(!empty($user)){
                return response()->json = [
                    'status' => True ,
                    'data' => $user,
                    'message' => trans('User Added Successfully'),
                ];
               }
               else{
                return response()->json =[
                    'status' => False ,
                    'message' => $ex->getMessage()
                ];
               }

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }
    public function getALLUser(){
        try{
              $validator = Validator::make($request->all(),[
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'contact' => 'required',
                'profile_image' => 'required',

               ]);
               if($validator->fails()){
                   return response()->json(['success' => false,'message' => $validator->messages()] ,200);
               }
            $getALLUser = User::all();
            return response()->json = [
                'status' => True ,
                'data' => $getALLUser,
                'message' => trans('Get All User Successfully'),
            ];

        }catch(Exception $ex){
            return response()->json =[
                'status' => False ,
                'message' => $ex->getMessage()
            ];
        }
    }
    public function getUser(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'id' => 'required',
               ]);
               if($validator->fails()){
                   return response()->json(['success' => false,'message' => $validator->messages()] ,200);
               }
            $id = $request->id;
            $getUser = User::find($id);
            if(!empty($getUser)){
                return response()->json = [
                    'status' => True ,
                    'data' => $getUser,
                    'message' => trans('Get Data Successfully'),
                ];
            }else{
                return response()->json = [
                    'status' => False ,
                    'message' => trans('User Not Found'),
                ];
            }
        }catch(Exception $ex){
            return response()->json =[
                'status' => False ,
                'message' => $ex->getMessage()
            ];
        }
    }
}
