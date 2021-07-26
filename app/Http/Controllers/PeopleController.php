<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleStoreRequest;
use App\Models\People;
use App\Services\ServiceGateway;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    private $serviceGateway;

    public function __construct(ServiceGateway $serviceGateway)
    {
        $this->serviceGateway = $serviceGateway;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return People::all();
    }




    public function store(PeopleStoreRequest $request)
    {
       $requestBody = $request->all();
       return $this->serviceGateway->peopleService->createPeople($requestBody);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        return $people;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }
}
