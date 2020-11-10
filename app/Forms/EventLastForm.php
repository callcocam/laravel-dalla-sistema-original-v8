<?php

namespace App\Forms;

use App\AbstractForm;
use App\Models\Admin\Client;

class EventLastForm extends AbstractForm
{



    public function buildForm()
    {
        if($this->getModel())
        {
            $this->add('id', 'hidden');

        }

        $this->add('slug', 'hidden')->add('end_event', 'hidden')
            ->add('name', 'text',[
                'label' => 'Nome',
            ])
            ->add('start_event', 'date',[
                'label' => 'Data Do Evento',
            ])->addClients()
            ->add('contractor', 'text',
                [
                    'label'=>'Contato do contratante'
                ])
            ->add('local', 'text',
                [
                    'label'=>'Local do evento'
                ])
            ->add('distance', 'text',
                [
                    'label'=>'Distância'
                ])
            ->add('chopp_price', 'text',
                [
                    'label'=>'Valor do chopp'
                ])
            ->add('trucks', 'text',
                [
                    'label'=>'Caminhão'
                ])
            ->add('truck_driver', 'text',
                [
                    'label'=>'Motorista'
                ])
            ->add('team', 'text',
                [
                    'label'=>'Equipe'
                ])
            ->add('departure_date_and_time', 'text',
                [
                    'label'=>'Data e horário de Saída da empresa'
                ])
            ->add('arrival_date_and_time', 'text',
                [
                    'label'=>'Data e horário de Chegada no evento'
                ])
            ->add('start_time_event', 'text',
                [
                    'label'=>'Horário de Início do evento'
                ])
            ->add('observations', 'textarea',
                [
                    'label'=>'Observações'
                ])

            ->add('pre_checklist', 'textarea',
                [
                    'label'=>'Pre-Checklist'
                ])
            ->addEventsInfo()
            ->addDescription()
            ->getStatus()
            ->addSubmit();

        parent::buildForm();

    }


    protected function addClients(){



        return  $this->add('client_id', 'entity',[
            'class' => Client::class,
            'query_builder' => function (Client $client) {
                // If query builder option is not provided, all data is fetched
                return $client->where('is_admin', 0);
            },
            'label'=>'Contratante',
            'empty_value' => '=== Selecione Contratante ==='
        ]);

    }

    protected function addEventsInfo(){



        if(!auth()->user()->hasAnyRole('gerente','super-admin'))
           return $this;

        $model = $this->getModel();


        if($model){

            $model->append('info');

        }

        return $this->add('info', 'form', [
            'label_attr' => ['class' => 'footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center'],
            'class' => EventsInfoForm::class,
            'wrapper' => false,
            'wrapper_class' => false,
            'label'=>"Informações importante"
        ]);

    }
}
