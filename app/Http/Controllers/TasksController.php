<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //los comentarios son del 09/02/2020.
        $filtro = isset($request->filtro) ? $request->filtro : "all";
        switch ($filtro) {
            case 'done':
                $tareas = Task::where('done', true)->get(); // Modificador de la url de tareas hechas
                break;
            case 'undone':
                $tareas = Task::where('done', false)->get(); // Modificador de la url de tareas sin hacer
                break;
            case 'bin':
                $tareas = Task::onlyTrashed()->get(); // Modificador de la url para tareas borradas
                break;
            case 'all':
            default:
                $tareas = Task::all();
                break;
        }
        $vista = view('index', ['tareas' => $tareas]);
        return $vista;
    }
    //fin del comentario.

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
        $validador = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
            ]
        );

        if ($validador->fails()) {
            return redirect('/')->withInput()->withErrors($validador);
        }

        $tarea = new Task;
        $tarea->name = $request->name;
        $tarea->done = false;
        $tarea->save();

        return redirect('/');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function done(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->done = true;
        $task->save();
        return redirect("/");
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function recover(Request $request, $id)
    {
        $task = Task::onlyTrashed()->where('id', $id)->firstOrFail();
        $task->restore();
        return redirect("/");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect("/");
    }
}
