<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore05Form extends AbstractForm
{



    public function buildForm()
    {
        $this->add('name', 'hidden',[
                'value' => 'ESTADO DAS MANGUEIRAS, EXTRATORAS E TORNEIRAS DE CHOPP?',
            ])
            ->addDescription('description','Estado Das Mangueiras, Extratores E Torneiras De Choop?',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
