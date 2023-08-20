<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\Auth;
class TagsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

       $tags= Tag::all();

       return view('tags.tags',[
           'title'=>'Tags List',
           'tags'=>$tags,
           'user'=>Auth::user(),
       ]);
       //dd($tags);
    }
    public function create(){
        return view('tags.create',[
            'tags'=>new Tag() // هادا الاوبجكت فاضي مش رح ينفذ اشي بس علشان احل قصة الform
        ]);

    }

    public function store(TagRequest $request){
//        $this->validateReq($request);

        $tag = new Tag();
        $tag->name=$request->input('name');
        $tag->slug=Str::slug($request->name);
        $tag->save();


        return redirect('/tags')->with('succes','Tag Added');

    }
    public function edit($id){

        //$tag=Tag::where('id','=',$id)->first();
       $tag= Tag::findOrFail($id);
       return view('tags.edit',[
           'tags'=>$tag
       ]);
    }
    public function update(TagRequest $request,$id){

//        $this->validateReq($request,$id);

        $tag= Tag::findOrFail($id);
        $tag->name=$request->input('name');
        $tag->slug=Str::slug($request->input('name'));
        $tag->save();

        return redirect('/tags')->with('succes','Tag Updated');

    }

    public function destroy($id){
        Tag::destroy($id);
        //2
        //Tag::where('id','=',$id)->delete();
        //3
//        $tag=Tag::findOrFail($id);
//        $tag->delet();
        return redirect('/tags')->with('succes','Tag Deleted');

    }
    protected function validateReq(Request $request, $id=0){
        $request->validate([
        ]);
    }




    //
}
