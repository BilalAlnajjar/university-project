<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::paginate(15);
        return response()->json($student);
    }

    public function generalPlanOfStudent($id){
        $student = Student::findOrFail($id);
        $general_plan = $student->department()->first()->generalPlan;
        return response()->json($general_plan);
    }

    public function departmentOfStudent($id){
        $student = Student::findOrFail($id);
        $department = $student->department;
        return response()->json($department);
    }

    public function customerPlansOfStudent($id){
        $student = Student::findOrFail($id);
        $customer_plan = $student->department()->first()->customerPlan;
        return response()->json($customer_plan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }


        if(Student::where('email',$request->email)->first()){
            return response()->json([
                    'Exaption' => 0 ,
                    'message' => 'this email is Duplicate',
                ]
            );
        }

        $password = Hash::make($request->password);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        $student->update($request->except('name','email','password'));

        if($request->remember_token){

            $remember_token = Hash::make($request->remember_token);
            $student->update([
                'remember_token' => $remember_token,
            ]);
        }

        return response($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
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
        $student = Student::findOrFail($id);

        if($request->password){
            $password = Hash::make($request->password);
            $student->update([
                'password' => $password,
            ]);

        }

        if($request->remember_token){

            $remember_token = Hash::make($request->remember_token);
            $student->update([
                'remember_token' => $remember_token,
            ]);
        }

        $student->update($request->except('remember_token','password'));

        return response($student);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required_without:email',
            'password' => 'required',
            'email' => 'required_without:username'
        ]);
        $user = null;
        if ($request->username) {
            $user = Student::where('username', $request->username)->first();
        } else if ($request->email) {
            $user = Student::where('email', $request->email)->first();
        }

        if ($user && Hash::check($request->password, $user->password)) {
            $token = Str::random(64);

            $user->api_token = $token;
            $user->save();

            return [
                'token' => $token,
            ];
        }

        return response()->json([
            'error' => 'Invalid Username Or Password',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'The student has been successfully deleted']);
    }





}
