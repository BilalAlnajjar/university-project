<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\CustomerPlan;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerPlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $customer_plane = CustomerPlan::whereId($id)->with('subjects')->paginate(15);
        return response()->json($customer_plane);
    }

//    public function customerPlansOfStudent($student_id){
//        $customer_plans = CustomerPlan::where('student_id', '==', $student_id)->paginate(15);
//        return response()->json($customer_plans);
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'student_id' => 'required|exists:students,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $customer_plans = CustomerPlan::created($request->only(['student_id']));

        return response()->json($customer_plans);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer_plans = CustomerPlan::findOrFail($id)->with('subjects')->get();
        return response()->json($customer_plans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'student_id' => 'exists:students,id',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $customer_plans = CustomerPlan::findOrFail($id);
        $customer_plans->update($request->only(['student_id']));

        return response()->json($customer_plans);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer_plans = CustomerPlan::findOrFail($id);
        $customer_plans->delete();

        return response()->json(['message' => 'The customer plan has been successfully deleted']);
    }
}
