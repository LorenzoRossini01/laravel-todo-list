<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StepController extends Controller
{

    /**
     * Store a newly created resource in storage.

     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
        ]);
        Step::create([
            'title' => $request->title,
            'description' => $request->description,
            'task_id' => $request->task_id,
        ]);
        return redirect()->route('tasks.show', $request->task_id);
        //
    }

    public function updateCompleted(Step $step)
{
    // Aggiorna lo stato di completamento del singolo step
    $step->completed = !$step->completed;
    $step->save();

    // Verifica se tutti gli step della task sono completati
    $task = $step->task;
    $allStepsCompleted = $task->steps()->where('completed', false)->doesntExist();

    // Se tutti gli step sono completati, segna anche la task come completata
    if ($allStepsCompleted) {
        $task->completed = true;
        $task->save();
    } else {
        $task->completed = false; // Assicurati che la task sia segnata come non completata se almeno uno step non è completato
        $task->save();
    }

    return redirect()->route('tasks.show', $task->id);
}

public function resetCompleted(Task $task)
{
    foreach ($task->steps as $step) {
        $step->completed = false;
        $step->save();
    }

    // Reindirizza alla pagina di dettaglio del task
    return redirect()->route('tasks.show', $task->id)->with('success', 'All steps have been reset!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        // Trova lo step
        $step = Step::find($id);
    
        // Controlla se lo step esiste
        if (!$step) {
            return redirect()->route('tasks.index')->with('error', 'Step not found.');
        }
    
        // Trova il task associato allo step
        $task = Task::find($step->task_id);
    
        // Elimina lo step
        $step->delete();
    
        // Reindirizza alla pagina di dettaglio del task
        return redirect()->route('tasks.show', $task->id);
    }
}
