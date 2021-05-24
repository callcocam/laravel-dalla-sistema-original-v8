<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore11Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'TEMPERATURA',
            ])
            ->add('description','text',[
                'label'=>'TEMPERATURA'
            ]);

        parent::buildForm();

    }


}
