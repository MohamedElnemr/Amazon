<?php

namespace Modules\User\http\controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use Modules\User\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function index():JsonResponse
    {
        // wallets list

        try {
            $wallet = Wallet::get();
            return $this->respondWithSuccess(WalletResource::collection($wallet));
        } catch (\Throwable $th) {
            return $this->respondNotFound($th->getMessage());
        }
    }

        // create new wallet

    public function store(Request $request):JsonResponse
    {
     $validator = Validator($request->all(),['user_id'=>'required','value'=>'required']);
     if($validator->fails()){
         return $this->respondFailedValidation('validation error');
     } else {
          try {

            $user = Wallet::where('user_id',$request->user_id)->first();

            if(!empty($user)){
                 $user->update(['value'=>$user->value + $request->value]);
                 return $this->respondWithSuccess(new WalletResource($user));
            } else {
                 $wallet = Wallet::create($request->all());
            return $this->respondWithSuccess(new WalletResource($wallet));
            }

        } catch (\Throwable $th) {
            return $this->respondNotFound($th->getMessage());
        }
     }

    }



//    show wallet

    public function show($id):JsonResponse
    {
        try {
            $wallet = Wallet::findOrFail($id);
            return $this->respondWithSuccess(new WalletResource($wallet));

        } catch (\Throwable $th) {
            return $this->respondNotFound($th->getMessage());
        }

    }

    //    update wallet

    public function update(Request $request, $id):JsonResponse
    {
        try {
            $wallet = Wallet::findOrFail($id);

             $wallet->update($request->all());
             return $this->respondWithSuccess(new WalletResource($wallet));

        } catch (\Throwable $th) {
            return $this->respondNotFound($th->getMessage());
        }
    }

//   delete wallet

    public function destroy($id):JsonResponse
    {
        try {
            $wallet = Wallet::findOrFail($id);

            $wallet->delete();
             return $this->respondWithSuccess(new WalletResource($wallet));

        } catch (\Throwable $th) {
            return $this->respondNotFound($th->getMessage());
        }
    }
}
