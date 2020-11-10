<?php

namespace App\Forms;

use App\AbstractForm;
use App\Models\Admin\Client;

class OderForm extends AbstractForm
{
    public function buildForm()
    {
        $this ->add('id', 'hidden')
            ->addClient()
            ->add('number', 'hidden',
                [
                    'label_show'=>false,
                    'attr'=>[
                        'readonly'=>true,
                    ],
                ]
            )
            ->add('delivery_date', 'hidden',
                [
                    'label_show'=>false,
                    'default_value'=>date("Y-m-d")
                ]
            )->add('description', 'textarea',[
                'label_show'=>false,
                'attr'=>[
                    'placeholder'=>"Descreva aqui alguma informação pertinente ao pedido",
                    'rows'=>"4",
                ]
            ])
            ->addStatus();

        parent::buildForm();
    }

    private function addStatus(){


        if(auth()->user()->hasAnyRole('cliente')){

            return $this->add('status', 'choice',[
                'choices'=>[
                    'not-accepted'=>'Aguardando Aprovação'
                ],
                'default_value'=>'not-accepted',
                'label_show'=>false,
                'expanded'=>true,
            ]);
        }

        if(!$this->getModel()){

            return $this->add('status', 'choice',[
                'choices'=>[
                    'not-accepted'=>'Aguardando Aprovação'
                ],
                'default_value'=>'not-accepted',
                'label_show'=>false,
                'expanded'=>true,
            ]);
        }

        if(in_array($this->getModel()->status, ['transit'=>'transit','completed'=>'transit'])){

            return $this->add('status', 'choice',[
                'choices'=>[
                    'transit'=>'Em transito','completed'=>'Completo'
                ],
                'default_value'=>'open',
                'label_show'=>false,
                'expanded'=>true,
            ]);
        }

        return $this->add('status', 'choice',[
            'choices'=>[
                'not-accepted'=>'Não aceito','open'=>'Aberto','transit'=>'Em transito','completed'=>'Completo'
            ],
            'default_value'=>'open',
            'label_show'=>false,
            'expanded'=>true,
        ]);

    }
    private function addClient(){


        if(auth()->user()->hasAnyRole('cliente')){

            return $this->add('client_id', 'hidden');
        }
        if($this->getData('status')){

            return $this->add('client_id', 'hidden');
        }


        return  $this->add('client_id', 'entity',[
            'class' => Client::class,
            'query_builder' => function (Client $client) {
                // If query builder option is not provided, all data is fetched
                return $client->where('is_admin', 0);
            },
            'label_show'=>false,
            'empty_value' => '=== Selecione Cliente ==='
        ]);
    }
}
