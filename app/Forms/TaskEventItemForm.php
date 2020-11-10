<?php

namespace App\Forms;

use App\AbstractForm;
use App\Models\Admin\Task;

class TaskEventItemForm extends AbstractForm
{
    public function buildForm()
    {

        $this->add('id', 'hidden',[
            'default_value'=>$this->getData('id')
        ])
            ->add('status', 'hidden',[
                'default_value'=>'draft'
            ])
            ->add('task_id', 'hidden',[
                'default_value'=>$this->getData('task_id')
            ])
            ->add('name', 'text',
                [
                    'label_show'=>false,
                    'default_value'=>$this->getData('name'),
                    'attr'=>[
                        'placeholder'=>"Digite aqui o valor pertinente a tarefa",
                        'title'=>"Descreva aqui o valor pertinente a tarefa, pode ser um número ou texto explicativo",
                    ]
                ]
            )
            ->add('description', 'text',
                [

                    'label_show'=>false,
                    'default_value'=>$this->getData('description'),
                    'attr'=>[
                        'placeholder'=>"Descreva aqui alguma informação pertinente a tarefa",
                    ]
                ]
            );

        parent::buildForm();
    }
}
