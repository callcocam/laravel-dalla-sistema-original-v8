<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore19Form extends AbstractForm
{

    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'CONTROLE DE BARRIS, COMO É REALIZADO?',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'CONTAGEM DIARIA'=>'CONTAGEM DIARIA',
                    'CONTAGEM SEMANAL'=>'CONTAGEM SEMANAL',
                    'CONTAGEM MENSAL'=>'CONTAGEM MENSAL',
                    'NÃO REALIZA CONTAGEM'=>'NÃO REALIZA CONTAGEM',
                ],
                'label'=>'CONTROLE DE BARRIS, COMO É REALIZADO?',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
