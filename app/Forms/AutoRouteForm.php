<?php

namespace App\Forms;

use App\AbstractForm;
use App\Suports\Shinobi\Helper;

class AutoRouteForm extends AbstractForm
{
    /**
     * @var Helper
     */
    private $helper;

    /**
     * MenuForm constructor.
     * @param Helper $helper
     */
    public function __construct(Helper $helper)
    {

        $this->helper = $helper;
    }

    public function buildForm()
    {
        if($this->getModel()){
            $this->add('id', 'hidden');
        }
        $this->add('slug', 'hidden')
            ->add('name', 'text',
                [
                    'label'=>'Nome'
                ])
            ->add('pattern', 'text')
            ->add('route', 'text')
            ->add('verb', 'choice',[
                'choices'=>[
                    "get"=>"GET", "post"=>"POST", "put"=>"PUT", "delete"=>"DELETE", "any"=>"ANY"
                ],
                'expanded'=>true,
            ])
            ->add('controller', 'text')
            ->add('method', 'text')
            ->add('resource', 'choice',[
                'choices'=>[
                    true=>"Yes", false=>"NO"
                ],
                'expanded'=>true,
            ])
            ->addDescription()
            ->getStatus()
            ->addSubmit();

        parent::buildForm();
    }


}
