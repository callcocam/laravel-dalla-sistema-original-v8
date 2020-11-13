<?php

namespace App\Forms;

use App\AbstractForm;
use App\Models\Admin\Task;

class TaskEventForm extends AbstractForm
{
    public function buildForm()
    {

        $tasks = Task::query()->where('status','published')->get(['id as task_id','name as taskName','slug']);

        if($tasks){

            foreach ($tasks as $task) {

                $this->addTask($task->slug, TaskEventItemForm::class,$task->name, $task);

            };
        }


        parent::buildForm();
    }


    protected function addTask($question,$class, $label, $task){

        $event = $this->getModel()->task()->where('task_id', $task->task_id)->first(['id','event_id','name','date_limit','description','status']);

        $data = $task->toArray();

        if($event){
            $data = array_merge($task->toArray(), $event->toArray());
        }


        return $this->add($question, 'form', [
            'label_attr' => ['class' => 'footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center'],
            'class' => $this->formBuilder->create($class, [
                'showStart'=>true,
                'showEnd'=>true,
            ], $data),
            'wrapper' => false,
            'wrapper_class' => false,
            'label'=>$label
        ]);
    }
}
