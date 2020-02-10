<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $table = 'tareas';

    public function getPriorityName()
    {
        $priority = $this->priority;
        switch ($priority) {
            case -2:
                return "Muy baja";
                break;
            case -1:
                return  "Baja";
                break;
            case 0:
                return  "Normal";
                break;
            case 1:
                return  "Alta";
                break;
            case 2:
                return  "Muy alta";
                break;
        }
    }
}
