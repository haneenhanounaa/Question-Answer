<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $search=request('search');
        $tag_id=request('tag_id');

        $questions=Question::with('user','tags')
            ->withCount('answers')->/*leftJoin('users','questions.user_id','=','users.id' )
            ->select([
                'questions.*',
                'users.name as user_name'
            ])
//            ->*/orderBy('created_at','DESC')
                ->latest()
                ->when($search,function ($query,$search){
                    $query->where('title','LIKE',"%{$search}%")
                    ->orWhere('description','LIKE',"%{$search}%");
                })
                ->when($tag_id,function ($query,$tag_id){
                    $query->whereHas('tags',function ($query)use($tag_id){
                        $query->where('id','=',$tag_id);
                    });
            })
                //->has('tags')
 //               ->doesntHave('tags')
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
        $tags= Tag::all();

        return view('questions.create',
            ['tags'=> $tags]);
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
            'tags'=>['required','array'],

        ]);

        $request->merge([
           //1 'user_id'=>$request->user()->id()

            'user_id'=>Auth::id() //2
        ]);

        DB::beginTransaction();

        try{
            $question=Question::create($request->all());
            $question->tags()->attach($request->input('tags'));

            DB::commit();

        }catch (\Throwable $e){
                DB::rollBack();
                throw $e;
        }


        return redirect()->route('questions.index')
            ->with('success','Question Added');


        //
    }

    /**
     * Display the specified resource.
     */
    public function  show(string $id)
    {
        $question=Question::leftJoin('users','questions.user_id','=','users.id' )
            ->select([
                'questions.*',
                'users.name as user_name'
            ])->findOrFail($id);

//        $answers=$question->answers()->with('user')->latest()->get();

        return view('questions.show',[
            'question'=>$question,
//            'answers'=>$answers,
        ]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question=Question::findOrFail($id);

        $tags=Tag::all();

        $question_tags=$question->tags()->pluck('id')->toArray();

        return view('questions.edit',[
            'question'=>$question,
            'tags'=>$tags,
            'question_tags'=>$question_tags ,
        ]);

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
            'status'=>['in:open,closed'],
            'tags'=>['required','array'],

        ]);

        DB::beginTransaction();

        try{
            $question->update($request->all());
            $question->tags()->sync($request->input('tags'));
            DB::commit();

        }catch (\Throwable $e){
            DB::rollBack();
            throw $e;
        }



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
