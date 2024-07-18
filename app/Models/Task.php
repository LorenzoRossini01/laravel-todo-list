<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'completed'];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function getCompletedTaskPercentage(){
        $totalSteps = $this->steps()->count();
        $completedSteps = $this->steps()->where('completed', true)->count();

        if($totalSteps === 0){
            return 0;
        }

        return ($completedSteps / $totalSteps) * 100;
    }

    public function progressColorClass(){
// Calcola il grado di completamento come percentuale
$completionPercentage = $this->getCompletedTaskPercentage();

// Definisci le soglie per il colore in base alla percentuale di completamento
if ($completionPercentage < 30) {
    return 'bad'; // Rosso per il completamento inferiore al 30%
} elseif ($completionPercentage < 70) {
    return  'medium'; // Giallo per il completamento tra il 30% e il 70%
} else {
    return  'good'; // Verde per il completamento superiore al 70%
}
    }
}
