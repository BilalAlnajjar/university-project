<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($question_id)
    {
        $answers = Answer::where('question_id', '=', $question_id)->get();
        if($answers->isEmpty()){
            return response()->json(['message' => 'Not found the answers to this question']);
        }
        return response()->json($answers);
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
           'question_id' => 'required|exists:questions,id',
            'textOfAnswer' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $answer = Answer::created($request->only(['question_id','textOfAnswer']));

        return response()->json($answer);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $answer = Answer::findOrFail($id);

        return response()->json($answer);
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
            'question_id' => 'exists:questions,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        //except or only

        $answer = Answer::findOrFail($id);
        $answer->update($request->only(['question_id','textOfAnswer']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return response()->json(['message' => 'The answer has been successfully deleted']);

    }
}
