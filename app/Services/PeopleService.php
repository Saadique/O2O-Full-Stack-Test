<?php


namespace App\Services;


use App\Events\NewPersonHasRegisteredEvent;
use App\Mail\WelcomeMail;
use App\Models\People;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PeopleService
{
    use ApiResponser;

    public function createPeople($requestBody){
        $emailExists = People::where('email', $requestBody['email'])->first();
        if ($emailExists) {
            return $this->errorResponse("Email Already Exists", 400);
        }

        $registerData = [
            'name' => $requestBody['name'],
            'email'  => $requestBody['email'],
            'password'   => $requestBody['password'],
            'remember_token'=>''
        ];
        $registerData['password'] = Hash::make($registerData['password']);
        $registerData['remember_token'] = Str::random(10);
        $person = People::create($registerData);
        $person->createToken('Laravel Password Grant Client')->accessToken;
        $person->save();


        event(new NewPersonHasRegisteredEvent($person));
        return $person;
    }


}
