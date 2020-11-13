<?php

namespace App\Forms;

use App\AbstractForm;

class BeersScoreForm extends AbstractForm
{



    public function buildForm()
    {
        if($this->getModel())
        {
            $this->add('id', 'hidden');

        }

        $this->add('id', 'hidden')
            ->add('name', 'hidden',[
                'value' => 'ARMAZENAMENTO DAS CHOPEIRAS',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'BEM ARMAZENADAS'=>'BEM ARMAZENADAS',
                    'ARMAZENAMENTO INCORRETO '=>'ARMAZENAMENTO INCORRETO ',
                ],
                'label'=>'Armazenamento Das Chooperias',
                'expanded'=>true,
            ])
            ->addDescription();

        parent::buildForm();

    }


}
