<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Percorso del file CSV delle tasks
        $csvFile = database_path('csv/tasks.csv');

        // Apre il file CSV in lettura
        $file = fopen($csvFile, 'r');

        // Verifica se il file è stato aperto correttamente
        if (!$file) {
            die("Errore nell'apertura del file CSV.");
        }

        // Ignora la prima linea (intestazione)
        $headers = fgetcsv($file);

        // Loop attraverso le righe del file CSV
        while (($task_data = fgetcsv($file)) !== false) {
            // Crea un nuovo oggetto Task
            $task = new Task;

            // Assegna i valori dalle colonne del CSV all'oggetto Task
            $task->title = $task_data[0];
            $task->description = $task_data[1];
            $task->completed = ($task_data[2] === 'true') ? true : false;

            // Salva il Task nel database
            $task->save();
        }

        // Chiude il file
        fclose($file);
    }
}
