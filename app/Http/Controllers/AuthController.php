<?php


namespace App\Http\Controllers;


use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request){
        $person = People::where('email', $request->email)->first();
        if ($person) {
            if (Hash::check($request->password, $person->password)) {
                $token = $person->createToken('Laravel Password Grant Client')->accessToken;
                $person->save();
                $response = [
                    'token'      => $token,
                    'person_id'     => $person->id,
                    'email'      => $person->email
                ];
                return response($response,200);
            }else{
                return $this->errorResponse("Sorry! Incorrect Password!", 400);
            }

        }else{
            return $this->errorResponse("The User Does NOT Exists!", 400);
        }
    }

}
