<?php

namespace App\Forms;

use App\AbstractForm;
use App\Forms\Beers\BeersScore01Form;
use App\Forms\Beers\BeersScore02Form;
use App\Forms\Beers\BeersScore03Form;
use App\Forms\Beers\BeersScore04Form;
use App\Forms\Beers\BeersScore05Form;
use App\Forms\Beers\BeersScore06Form;
use App\Forms\Beers\BeersScore07Form;
use App\Forms\Beers\BeersScore08Form;
use App\Forms\Beers\BeersScore09Form;
use App\Forms\Beers\BeersScore10Form;
use App\Forms\Beers\BeersScore11Form;
use App\Forms\Beers\BeersScore12Form;
use App\Forms\Beers\BeersScore13Form;
use App\Forms\Beers\BeersScore14Form;
use App\Forms\Beers\BeersScore15Form;
use App\Forms\Beers\BeersScore16Form;
use App\Forms\Beers\BeersScore17Form;
use App\Forms\Beers\BeersScore18Form;
use App\Forms\Beers\BeersScore19Form;
use App\Forms\Beers\BeersScore20Form;
use App\Forms\Beers\Score01Form;
use App\Forms\Beers\Score02Form;
use App\Forms\Beers\Score03Form;
use App\Models\Admin\Client;
use App\Models\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class VisitsDistributorForm extends AbstractForm
{



    public function buildForm()
    {
        if($this->getModel())
        {
            $this->add('id', 'hidden');

        }

        $this->addClients()
            ->add('resbonsible', 'text',
                [
                     'label'=>'Responsável'
                ])
            ->add('date_visit', 'date',
                [
                    'label'=>'Data da visita'
                ])
            ->add('quantity_of_distributor_draft_beer', 'text',
                [
                    'label'=>'Quantidade de chopeiras do distribuidor'
                ])
            ->add('quantity_of_matriz_draft_beer', 'text',
                [
                    'label'=>'Quantidade de chopeiras da Dalla Carvejaria'
                ])
            ->add('number_of_distributor_barrels', 'text',
                [
                    'label'=>'Quantidade de barris do distribuidor'
                ])
            ->add('number_of_matriz_barrels', 'text',
                [
                    'label'=>'Quantidade de barris da Dalla Cervejaria'
                ])
            ->addDescription('cities_serving_region', 'Cidades que atende na região',
                [
                    'rows'=>'3'
                ])
            ->addDescription('meet_each_city', 'De que forma atende em cada cidade',
                [
                    'rows'=>'3'
                ])
            ->addQuestion('question-01', BeersScore01Form::class,'02 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-02', BeersScore02Form::class,'02.1 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-03', BeersScore03Form::class,'02.2 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-04', BeersScore04Form::class,'02.3 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-05', BeersScore05Form::class,'02.4 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-06', BeersScore06Form::class,'02.5 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-07', BeersScore07Form::class,'02.6 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-08', BeersScore08Form::class,'02.7 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-09', BeersScore09Form::class,'02.8 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            ->addQuestion('question-10', BeersScore10Form::class,'02.9 - AVALIAÇÃO GERAL DO ESTABELECIMENTO')
            //->addQuestion('score-01', Score01Form::class,'AVALIAÇÃO FINAL DO ESTABELECIMENTO')
            ->addQuestion('question-11', BeersScore11Form::class,'03 - CONDIÇÕES DA C MARA FRIA')
            ->addQuestion('question-12', BeersScore12Form::class,'03.1 - CONDIÇÕES DA C MARA FRIA')
            ->addQuestion('question-13', BeersScore13Form::class,'03.2 - CONDIÇÕES DA C MARA FRIA')
           // ->addQuestion('score-02', Score02Form::class,'AVALIAÇÃO FINAL CONDIÇÕES DA C MARA FRIA')
            ->addQuestion('question-14', BeersScore14Form::class,'04 - DESEMPENHO DA DALLA CERVEJARIA COM O DISTRIBUIDOR')
            ->addQuestion('question-15', BeersScore15Form::class,'04.1 - DESEMPENHO DA DALLA CERVEJARIA COM O DISTRIBUIDOR')
            ->addQuestion('question-16', BeersScore16Form::class,'04.2 - DESEMPENHO DA DALLA CERVEJARIA COM O DISTRIBUIDOR')
            ->addQuestion('question-17', BeersScore17Form::class,'04.2 - DESEMPENHO DA DALLA CERVEJARIA COM O DISTRIBUIDOR')
            ->addQuestion('question-18', BeersScore18Form::class,'04.3 - DESEMPENHO DA DALLA CERVEJARIA COM O DISTRIBUIDOR')
            ->addQuestion('question-19', BeersScore19Form::class,'04.4 - DESEMPENHO DA DALLA CERVEJARIA COM O DISTRIBUIDOR')
            ->addQuestion('question-20', BeersScore20Form::class,'04.5 - DESEMPENHO DA DALLA CERVEJARIA COM O DISTRIBUIDOR')
            //->addQuestion('score-03', Score03Form::class,'AVALIAÇÃO FINAL DESEMPENHO DA D. CERVEJARIA COM O DISTRIBUIDOR')
            ->addDescription('considerations_distributor','Considerações Distribuidor')
            ->addDescription('considerations_beer','Considerações Da Cervejaria')
            ->addDescription('comparative_privious_year', 'Comparativo De crescimento')
            ->add('file', 'file',
                [
                    'label'=>'Selecione As Imagem',
                    'attr'=>[
                        'multiple' => true
                    ]
                ])
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
            'label'=>'Cliente',
            'rules' => 'required',
            'empty_value' => '=== Selecione Cliente ==='
        ]);

    }

    protected function addQuestion($question,$class, $label){

        $model = $this->getModel();


        $beers_scores = null;

        if($model){

            $model->setQuestion($question);

            $model->append($question);

        }

        return $this->add($question, 'form', [
            'label_attr' => ['class' => 'footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center'],
            'class' => $this->formBuilder->create($class),
            'wrapper' => false,
            'wrapper_class' => false,
            'label'=>$label
        ]);
    }

}
