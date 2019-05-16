<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class questionController extends Controller
{

    public function __construct() {
        $this->middleware('auth',
            [
                'expect' => ['index', 'show']
            ]
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();

        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'description'));

        return redirect()->route('questions.index')->with('success', 'You Question Was Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {

        // With Service Provider
        /*if (Gate::denies('update-question', $question)) {

            abort(403, 'Access Denied');

        }*/

        $this->authorize('update', $question);

        return view('questions.edit', compact('question'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {

        /*if (Gate::denies('update-question', $question)) {

            abort(403, 'Access Denied');

        }*/

        $this->authorize('update', $question);

        $question->update($request->only('title', 'description'));

        return redirect()->route('questions.index')->with('success', 'Question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {

        /*if (Gate::denies('delete-question', $question)) {

            abort('403', 'Access Denied');

        }*/

        $this->authorize('delete', $question);

        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Your Question has been deleted');
    }
}