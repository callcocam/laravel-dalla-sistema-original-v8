<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore04Form extends AbstractForm
{



    public function buildForm()
    {
        $this->add('name', 'hidden',[
                'value' => 'ROTINAS DE HIGINEIZAÇÃO',
            ])
            ->addDescription('description','DATAS DAS ÚLTIMAS HIGIENIZAÇÕES?',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
