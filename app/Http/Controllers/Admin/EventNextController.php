<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Events\PosNextEvent;
use App\Forms\EventNextForm;
use App\Forms\TaskEventForm;
use App\Http\Requests\EventNextStore;
use App\Http\Requests\PosEventStore;
use App\Models\Admin\EventNext;
use App\Models\Admin\EventTask;
use App\Models\Admin\Task;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class EventNextController extends AbstractController
{

   protected $template = 'events-next';

   protected $model = EventNext::class;


   protected $event = PosNextEvent::class;

   protected $formClass = EventNextForm::class;

   public function index()
   {

       $this->getSource()->orderBy('start_event')->whereBetween('start_event', [
           Carbon::now(),
           Carbon::now()->addMonths(1000)->endOfMonth()
       ]);
       return parent::index();
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventNextStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventNextStore $request)
    {
        return $this->save($request);
    }

    public function task(Request $request, $id){

        $rows = $this->getModel()->findById($id);

        $this->results['form'] = $this->formBuilder->create(TaskEventForm::class,
            [
                'model' => $rows,
                'method' => 'POST',
                'url' => route("admin.tasks-next.update", $id)
            ]);


        $this->results['user'] = Auth::user();

        $this->results['rows'] =$rows;

        $this->results['tenant'] = get_tenant();

        return view(sprintf('admin.%s.task', $this->template), $this->results);
    }


    public function taskList (Request $request, $id){

        $rows = $this->getModel()->findById($id);

        $this->results['form'] = $this->formBuilder->create(TaskEventForm::class,
            [
                'model' => $rows,
                'method' => 'POST',
                'url' => route("admin.tasks-next.update", $id)
            ]);


        $this->results['user'] = Auth::user();

        $this->results['rows'] =$rows;

        $this->results['tenant'] = get_tenant();

        return view(sprintf('admin.%s.task-list', $this->template), $this->results);
    }


    public function print($id)
    {
        $rows = $this->getModel()->findById($id);

        if(!$rows){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

            return back()->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

        }
        $this->results['user'] = Auth::user();

        $this->results['rows'] =$rows;

        $this->results['tenant'] = get_tenant();

        /**
         * @var Dompdf $pdf
         */
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML(view(sprintf('admin.%s.print', $this->template), $this->results));

        return $pdf->stream();
        //return view(sprintf('admin.%s.print', $this->template), $this->results);
    }


    public function updateTask(Request $request,$id){

        if (! $request->expectsJson()) {
            return back();
        }
       $updated = false;

        $rows = $this->getModel()->findById($id);


        if($rows){

            $tasks = $request->all();

            foreach ($tasks as $key => $task) {
               $parent = Task::query()->where('slug',$key)->first();
               if($parent){

                   if($task['name']){

                       $updated = true;

                       $task['event_id'] = $id;

                       $eventTask = $rows->task()->where('task_id', $task['task_id'])->first();
                       if($eventTask):
                           $task['id'] = $eventTask->id;
                           $eventTask->saveBy($task);
                       else:
                           $rows->task()->create($task);
                       endif;

                   }
                   else{

                       if($task['id']){
                           $rows->task()->where('id', $task['id'])->delete();
                       }
                   }
               }

            }
        }

        if ($updated){

            return response()->json([
                'message'=>'Tarefas atualizadas com sucesso!!',
                'result'=>$updated
            ]);
        }
        return response()->json([
            'message'=>'Nenhuma tarefa foi criada ou atualizada!!',
            'result'=>$updated
        ]);
    }

    public function posEvent(PosEventStore $request){


        $rows = $this->getModel()->findById($request->get('event_id'));

        if($rows){
            $posEvent = $rows->pos_event()->first();

            if($posEvent):
                $posEvent->saveBy($request->all());

                if($posEvent->getResultLastId()){
                    return response()->json([
                        'type'=>'success',
                        'message'=>$posEvent->getMessage()
                    ]);

                }
            endif;
        }

        return response()->json([
            'type'=>'danger',
            'message'=>$posEvent->getMessage()
        ], 500);
    }

    public function deleteTask($id)
    {
        $this->model = EventTask::class;

        $model = $this->getModel()->findById($id);

        if(!$model){


            return response()->json([
                "result"=>false,
                'message'=>"O modelo não foi informado, se o problema persistir contate o administardor!!!!"
            ]);

        }

        if($this->getModel()->deleteBy($model)){
            notify()->success($this->getModel()->getMessage());
            return response()->json([
                "result"=>true,
                'message'=> $this->getModel()->getMessage()
            ]);
        }

        return response()->json([
            "result"=>false,
            'message'=>"O modelo não foi informado, se o problema persistir contate o administardor!!!!"
        ]);

    }

}
