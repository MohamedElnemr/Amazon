<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Jobs\ForgetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    use UserResource;
    public function update(UserRequest $request): JsonResponse
    {
        $user = auth()->user();
        $user = User::find($request->post_id);
        if($user)
        {
            $user->update($request->all());
            return $this->respondWithSuccess(new UserResource($user));
        }
        else
        {
           return $this->respondError('Error Not Found');
        }
    }

    public function destroy(Request $request)
    {
        try{
        $user = auth()->user();
        $user = User::find($id);
        if($user)
        {
            $user->delete();
            return $this->respondWithSuccess('User Deleted Successfly');
        }
        else
        {
           return $this->respondError('Error Not Found');
        }
        }catch(Exception $e)
        {
            return $this->respondError($e->getMessage());
        }
    }

    public function restore(Request $request)
    {
        try{
        $user = auth()->user();
        $user = User::withTrashed()->find($request->id);
        if($user)
        {
            $user->restore();
            return $this->respondOk('Restore Succssfuly');
        }
        }catch(Exception $e)
        {
           return $this->respondError($e->getMessage());
        }
    }

    public function hardDelete(Request $request)
    {
        try {
            $user = auth()->user();
            $post = Post::withTrashed()->where('id',$id)->first();
            if($user)
            {
                $post->forceDelete();
            }
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function forget_password(Request $request){

        $user = User::where('email',$request->email)->first();
        $code = $user->forget_code = Str::random(20);
        $user->code_expire = Carbon::now()->addHour();
        $user->save();

        $data = [
            'email'=>$request->email,
            'view'=> 'forget-password',
            'data'=>[
                  'code'=> $code,
                  'link'=>env('FRONT_URL'),
                    ],
        ];

             ForgetPassword::dispatch($data);
       }

       

       public function reset_password(Request $request){

           $request->validate($request->all(),[
               'password'=>'required|confirmed',
               'code'=>'required',
           ]);

           $user = User::where('code',$request->code)->first();
           if(!empty($user)){
               if($user->code_expire > Carbon::now()){

                $user->password = Hash::make($request->password);
                $user->save();
               } else {
                   return "code invalid";
               }
               }else{
                return "user not found";

           }


       }
}
