<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteMessage;
use App\Jobs\StoreMessage;
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


    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $requestBody = $request->all();
        return $this->dispatch(new StoreMessage($requestBody, $this->serviceGateway));
    }


    public function show(Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($message_id)
    {
        return $this->dispatch(new DeleteMessage($message_id, $this->serviceGateway));
    }

}
