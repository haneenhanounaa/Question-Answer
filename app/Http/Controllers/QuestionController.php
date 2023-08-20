<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions=Question::leftJoin('users','questions.user_id','=','users.id' )
            ->select([
                'questions.*',
                'users.name as user_name'
            ])
//            ->orderBy('created_at','DESC')
                ->latest()
            ->simplePaginate(2);

        return view('questions.index',[
            'questions' => $questions,
                ]);

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required','string','max:255'],
            'description'=>['required','string'],
        ]);
        $request->merge([
           //1 'user_id'=>$request->user()->id()

            'user_id'=>Auth::id() //2
        ]);

        $question=Question::create($request->all());

        return redirect()->route('questions.index')
            ->with('success','Question Added');


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question=Question::leftJoin('users','questions.user_id','=','users.id' )
            ->select([
                'questions.*',
                'users.name as user_name'
            ])->findOrFail($id);

        return view('questions.show',[
            'question'=>$question,
        ]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question=Question::findOrFail($id);

        return view('questions.edit',[
            'question'=>$question,
        ]);

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question=Question::findOrFail($id);

        $request->validate([
            'title'=>['required','string','max:255'],
            'description'=>['required','string'],
            'status'=>['in:open,closed']
        ]);

        $question->update($request->all());

        return redirect()->route('questions.index')
            ->with('success','Question Updated');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::destroy($id);

        return redirect()->route('questions.index')
            ->with('success','Question Deleted');

        //
    }
}
