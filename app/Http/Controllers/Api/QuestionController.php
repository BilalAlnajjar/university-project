<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sub_subject_id)
    {
        $questions = Question::where('sub_subject_id', '==', $sub_subject_id)->paginate(15);
        return $questions;
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
            'title' => 'required|string' ,
            'textOfQuestion' => 'required |min:3',
            'sub_subject_id' => 'required|exists:sup_subjects,id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $question = Question::created($request->only(['title','textOfQuestion','sub_subject_id']));

        return response()->json($question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::findOrFail($id)->with('answer')->get();
        return response()->json($questions);
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
            'title' =>  'string' ,
            'textOfQuestion' => 'min:3',
            'sub_subject_id' => 'exists:sup_subjects,id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $question = Question::findOrFail($id);
      $question->update($request->only(['title','textOfQuestion','sub_subject_id']));

      return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'The question has been successfully deleted']);
    }
}
