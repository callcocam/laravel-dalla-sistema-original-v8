<?php

namespace App\Forms;

use App\AbstractForm;

class ProfileForm extends AbstractForm
{
    public function buildForm()
    {
        if($this->getModel()){
            $this->add('id', 'hidden');
            $this->getModel()->append('address');
        }
        $this->add('slug', 'hidden')
            ->add('name', 'text',[
                'label'=>'Nome',
                'rules'=>'required'
            ])
            ->add('email', 'email',[
                'label'=>'E-Mail',
                'rules'=>'required'
            ])
            ->addPassword()
            ->add('phone', 'tel',[
                'label'=>'Telefone'
            ])
            ->add('document', 'text',[
                'label'=>'Cpf/Cnpj'
            ])
            ->add('address', 'form', [
                'label_attr' => ['class' => 'footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center'],
                'class' => $this->formBuilder->create(AddresForm::class),
                'wrapper' => false,
                'label' => "Endereço",
                'wrapper_class' => false,
            ])
            ->addDescription()
            ->addSubmit();

        parent::buildForm();
    }


    protected function addPassword(){

        if($this->getModel()){
            //return  $this;
        }

        return  $this->add('password', 'password',[
            'label'=>'Senha'
        ]);

    }
}
