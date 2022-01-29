<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompleted;
use App\Models\ToDo;
use Illuminate\Http\Request;
use App\Notifications\SendMail;
use Illuminate\Support\Facades\Mail;


class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *d
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = auth()->user()->todos()->paginate(2);

        return view('home', [
            'todos' => $todos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);

//        dd(auth()->user()->todos);
        auth()->user()->todos()->create([
            'text' => $request->text,
            'status'=> 'incomplete',
        ]);

//        ToDo::create([
//            'text' => $request->text,
//            'status'=> 'incomplete',
//            'user_id'=>auth()->user()->id
//        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $todos = collect();

        if($request->search){
            $todos = auth()->user()->todos()->where('text', 'LIKE', "%$request->search%")->get();
        }

        return view('search', [
            'todos' => $todos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDo $todo)
    {
        return view('edit', [
            'todo' => $todo
        ]);
    }

    public function toggleCompletion(Request $request)
    {

        $todo = ToDo::find($request->id);
        if($todo){

            if($todo->status == "completed"){
                $todo->status = "incomplete";
            } else {
                $todo->status = "completed";
                $user = auth()->user();

                Mail::to($user)->send(new TaskCompleted($user, $todo));

            }

//            dd($todo->status);

            $todo->save();

        } else {
            return back()->with('status', 'Error');
        }


        $todos = auth()->user()->todos()->paginate(2);

        return view('home', [
            'todos' => $todos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDo $todo)
    {
        $todo = ToDo::where('id', $request->id);
//        $todo->text = $request->text;
        $todo->update([
            'text' => $request->text
        ]);
//        $todo->save();

        $todos = auth()->user()->todos()->paginate(2);

        return view('home', [
            'todos' => $todos
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ToDo $todo)
    {
        $todo->delete();

        return redirect(route('todos'));
    }
}
