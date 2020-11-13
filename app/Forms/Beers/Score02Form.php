<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class Score02Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'AVALIAÇÃO FINAL CONDIÇÕES DA C MARA FRIA',
            ])->add('visits', 'hidden',[
                'value' => 'score-02',
            ])
           ->add('selected', 'choice',[
                'choices'=>['01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05',
                    '06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10' ],
                'label'=>'AVALIAÇÃO FINAL CONDIÇÕES DA C MARA FRIA',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
