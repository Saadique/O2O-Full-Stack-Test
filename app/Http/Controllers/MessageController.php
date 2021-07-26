<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteMessageJob;
use App\Jobs\StoreMessageJob;
use App\Models\Message;
use App\Services\ServiceGateway;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    private $serviceGateway;

    public function __construct(ServiceGateway $serviceGateway)
    {
        $this->serviceGateway = $serviceGateway;
    }



    public function store(Request $request)
    {
        $requestBody = $request->all();
        return $this->dispatch(new StoreMessageJob($requestBody, $this->serviceGateway));
    }


    public function destroy($message_id)
    {
        return $this->dispatch(new DeleteMessageJob($message_id, $this->serviceGateway));
    }

}
