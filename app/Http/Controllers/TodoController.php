<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
       $todos = auth()->user()->todos()->OrderBy("id")->get();
       return view("todos.index",compact("todos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("todos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:255|unique:todos",
            "description" => "required",
            "image" => "required|image|mimes:jpg,jpeg,png,gif|max:2048",
        ]);
        $image = $request->file("image");
        $file = md5(microtime()).".".$image->getClientOriginalExtension();
        $image->move(public_path("/todo"),$file);
        
        $data = [
            "title" => $request->title,
            "description" => $request->description,
            "image" =>$file,
            "slug" => str_slug($request->title)
        ];
        auth()->user()->todos()->create($data);
        return redirect("todolist")->with("status","Item has been saved.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    { 
        $user = auth()->user();
        return view('todos.show',compact('todo','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
       return view("todos.edit",compact("todo"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        "title" => "required|max:255",
        ]);
        $todo = Todo::FindOrFail($id);

        if($request->image != ""):
            $request->validate([
                "image" => "image|mimes:jpg,jpeg,png,gif|max:2048",
            ]);
            $image = $request->file("image");
            $file = md5(microtime()).".".$image->getClientOriginalExtension();
            $image->move(public_path("/todo"),$file);

            $path = public_path("todo/");

            if($todo->image != NULL || $todo->image == ""):
            $old = $path.$todo->image;
            unlink($old);
            endif;

            $todo->update([
                "image" =>$file,
            ]);
        endif;
        $todo->update([
            "title" => $request->title,
            "slug" => str_slug($request->title)
        ]);
        return redirect("todolist")->with("status","Item has been updated");
    }
    public function complete(Request $request, $id){
        $todo = Todo::FindOrFail($id);
        if($todo->complete):
            return redirect('todolist')->with('error','Task is already completed.');
        else:
            $todo->update([
            'complete' => true
            ]);
        endif;
        return redirect('todolist')->with('status','Task has been completed.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $todo = Todo::FindOrFail($id);
        $path = public_path("todo/");

        if($todo->image != NULL || $todo->image == ""):
        $old = $path.$todo->image;
            unlink($old);
        endif;

        $todo->delete();
        return redirect('todolist')->with('status','Task has been deleted.');
    }
    
}
