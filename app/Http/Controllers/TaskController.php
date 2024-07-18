<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tasks = Task::orderBy('updated_at','desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
         $tasks = Task::orderBy('updated_at','desc')->get();

        return view('tasks.create', compact('tasks'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *

     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     *

     */
    public function show(Task $task)
    {
        $is_creating=false;
        $tasks = Task::orderBy('updated_at','desc')->get();
        //get all step of the task
        $steps = Step::where('task_id', $task->id)->orderBy('created_at','DESC')->get();

        return view('tasks.show', compact('task','tasks','steps','is_creating'));
        //
    }

        //


    /**
     * Show the form for editing the specified resource.

     */
    public function edit(Task $task)
    {
        $tasks = Task::orderBy('updated_at','desc')->get();
        return view('tasks.edit', compact('task','tasks'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['required','string'],
        ]);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success','Task updated successfully');

        //
    }

    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Task deleted successfully');
        //
    }
}
