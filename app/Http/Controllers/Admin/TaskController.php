<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\TaskForm;
use App\Http\Requests\TaskStore;
use App\Models\Admin\Task;

class TaskController extends AbstractController
{

   protected $template = 'tasks';

   protected $model = Task::class;

   protected $formClass = TaskForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param TaskStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStore $request)
    {
        return $this->save($request);
    }
}
