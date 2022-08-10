<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubMajor;
use Illuminate\Http\Request;

class SubMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_majors = SubMajor::paginate(15);
        return response()->json($sub_majors);
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
            'name' => 'required|min:3',
            'definition' => 'required|min:10',
            'description ' => 'min:10',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $sub_major = SubMajor::create($request->only(['name','definition','description']));

        return response()->json($sub_major);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_major = SubMajor::findOrFail($id);

        return response()->json($sub_major);
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
            'name' => 'min:3',
            'definition' => 'min:10',
            'description ' => 'min:10',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        $sub_major = SubMajor::findOrFail($id);

        $sub_major->update($request->only(['name','definition','description']));

        return response()->json($sub_major);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_major = SubMajor::findOrFail($id);

        $sub_major->delete();

        return response()->json("The submajor deleted succssfuly");
    }
}
