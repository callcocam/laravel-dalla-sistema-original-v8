<?php

namespace App\Forms;

use App\AbstractForm;

class SettingForm extends AbstractForm
{
    public function buildForm()
    {
        if($this->getModel()){
            $this->add('id', 'hidden');
        }
        $this->add('slug', 'hidden')
            ->add('name', 'text',[
                'label'=>'Nome'
            ])
            ->add('email', 'email',[
                'label'=>'E-Mail'
            ])
            ->add('phone', 'tel',[
                'label'=>'Telefone'
            ])
            ->add('document', 'text',[
                'label'=>'Cpf/Cnpj'
            ])
            ->add('cover', 'file',[
                'label'=>'Capa'
            ])
            ->add('address', 'form', [
                'label_attr' => ['class' => 'footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center'],
                'class' => $this->formBuilder->create(AddresForm::class),
                'wrapper' => false,
                'wrapper_class' => false,
            ])
            ->addDescription()
            ->getStatus()
            ->addSubmit();

        parent::buildForm();
    }

}
