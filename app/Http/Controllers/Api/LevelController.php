<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::paginate(15);
        return response()->json($levels);
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
            'description' => 'min:3',
            'sub_major_id' => 'required| exists:sub_majors,id',
            'general_plan_id' => 'required| exists:general_plans,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $levels = Level::create($request->only(['name','definition','description']));

        return response()->json($levels);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = Level::findOrFail($id);
        return response()->json($level);
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
            'description' => 'min:3',
            'sub_major_id' => 'exists:sub_majors,id',
            'general_plan_id' => 'exists:general_plans,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        $level = Level::findOrFail($id);

        $level->update($request->only(['name','definition','description']));

        return response()->json($level);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::findOrFail($id);

        $level->delete();

        return response()->json("the level deleted succssfuly");

    }
}
