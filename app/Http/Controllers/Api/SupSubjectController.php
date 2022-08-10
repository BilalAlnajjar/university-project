<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupSubject;
use Illuminate\Http\Request;

class SupSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_subjects= SupSubject::paginate(15);
        return response()->json($sub_subjects);
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
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'subject_id  ' => 'required| exists:sup_subjects,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $sub_subject = SupSubject::create($request->only(['title','description','subject_id']));

        return response()->json($sub_subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_subject = SupSubject::findOrFail($id);

        return response()->json($sub_subject);
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
            'title' => 'min:3',
            'description' => 'min:10',
            'subject_id  ' => 'exists:sup_subjects,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        $sub_subject = SupSubject::findOrFail($id);

        $sub_subject->update($request->only(['title','description','subject_id']));

        return response()->json($sub_subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_subject = SupSubject::findOrFail($id);

        $sub_subject->delete();

        return response()->json("The subsubject deleted succssfuly");
    }
}
