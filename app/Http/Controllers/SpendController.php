<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Spend;
use Validator;

class SpendController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spends = Spend::all();

        return $this->sendResponse($spends->toArray(), 'spends retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'value' => 'required',
            'supplier' => 'required',
            'description' => 'required',
            'spending_date' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error', $validator->errors());
        }

        $spend = Spend::create($input);

        return $this->sendResponse($spend->toArray(), 'Spend created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function show(Spend $spend)
    {
        $found = Spend::find($spend);

        if(is_null($found)){
            return $this->sendError('Spend not found');
        }

        return $this->sendResponse($found->toArray(), 'Send retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function edit(Spend $spend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spend $spend)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'value' => 'required',
            'supplier' => 'required',
            'description' => 'required',
            'spending_date' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error', $validator->errors());
        }

        $spend->value = $input['value'];
        $spend->supplier = $input['supplier'];
        $spend->description = $input['description'];
        $spend->spending_date = $input['spending_date'];
        $spend->save();

        return $this->sendResponse($spend->toArray(), 'Spend updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spend $spend)
    {
        $spend->delete();

        return $this->sendResponse($spend->toArray(), 'Spend deleted successfully.');
    }
}
