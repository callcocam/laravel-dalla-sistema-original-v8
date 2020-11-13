<?php

namespace App\Forms;

use App\AbstractForm;

class EventsInfoForm extends AbstractForm
{



    public function buildForm()
    {

       $this->addDescription('important','Informações Importantes',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
