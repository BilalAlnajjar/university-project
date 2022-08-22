<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Department;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate(15);
        return response()->json($subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'definition' => 'required|min:10',
            'department_id ' => 'required| exists:departments,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $subject = Subject::create($request->only(['name','definition','department_id']));

        return response()->json($subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::findOrFail($id);

        return response()->json($subject);

    }

    public function userSupjects($user_id){
        $subjects = Student::findOrFail($user_id)->department()->first()->subjects()->with('subSubjects')->get();

        return $subjects;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'min:3',
            'definition' => 'min:10',
            'department_id ' => 'exists:departments,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        $subject = Subject::findOrFail($id);

        $subject->update($request->only(['name','definition','department_id']));

        return response()->json($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);

        $subject->delete();

        return response()->json("deleted is succssfuly");
    }
}
