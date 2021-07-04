<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Repayments;
use Illuminate\Http\Request;
use App\Http\Resources\RepaymentsResource;
use Illuminate\Support\Facades\Validator;


class RepaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repayments = Repayments::all();
        return response([ 'repayments' => RepaymentsResource::collection($repayments), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'loan_id' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $repayments = Repayments::create($data);

        return response([ 'repayments' => new RepaymentsResource($repayments), 'message' => 'Created successfully'], 200);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repayments  $repayments
     * @return \Illuminate\Http\Response
     */
    public function show(Repayments $repayments)
    {
        return response([ 'repayment' => new RepaymentsResource($repayments), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repayments  $repayments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repayments $repayments)
    {
        $repayments->update($request->all());

        return response([ 'repayments' => new RepaymentsResource($repayments), 'message' => 'Retrieved successfully'], 200);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repayments  $repayments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repayments $repayments)
    {
        $repayments->delete();
        return response(['message' => 'Deleted']);
    }
}
