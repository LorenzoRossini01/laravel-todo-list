<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Step;
use App\Models\Task;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Percorso del file CSV dei steps
        $csvFile = database_path('csv/steps.csv');

        // Apre il file CSV in lettura
        $file = fopen($csvFile, 'r');

        // Verifica se il file è stato aperto correttamente
        if (!$file) {
            die("Errore nell'apertura del file CSV.");
        }

        // Ignora la prima linea (intestazione)
        $headers = fgetcsv($file);

        // Loop attraverso le righe del file CSV
        while (($steps_data = fgetcsv($file)) !== false) {
            // Crea un nuovo oggetto Step
            $step = new Step;

            // Assegna i valori dalle colonne del CSV all'oggetto Step
            $step->title = $steps_data[0] ?? null; // Assicura che l'indice esista o è null
            $step->description = $steps_data[1] ?? null;
            $step->completed = isset($steps_data[2]) && $steps_data[2] === 'true'; // Converte in booleano direttamente
            $step->task_id = $steps_data[3] ?? null; // Assicura che l'indice esista o è null

            // Verifica se task_id esiste nella tabella Task
            if ($step->task_id && Task::where('id', $step->task_id)->exists()) {
                // Salva il Step nel database
                $step->save();
            } else {
                echo "Errore: task_id non valido o non esiste nel database per il Step:\n";
                var_dump($steps_data); // Stampa per debug
            }
        }

        // Chiude il file
        fclose($file);
    }
}
