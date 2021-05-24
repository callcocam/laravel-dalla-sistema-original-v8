<?php

namespace App\Forms;

use App\AbstractForm;

class ContractForm extends AbstractForm
{
    public function buildForm()
    {
        if($this->getModel()){
            $this->add('id', 'hidden');
        }

        $this->add('password', 'hidden', [
                'value'=>date("YmdHis")
            ])
            ->add('is_admin', 'hidden', [
                'value'=>'2'
            ])
            ->add('slug', 'hidden')
            ->add('name', 'text',[
                'label'=>'Razão Social'
            ])
            ->add('fantasy', 'text',[
                'label'=>'Nome Fantasia'
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
            ->add('address', 'form', [
                'label_attr' => ['class' => 'footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center'],
                'class' => $this->formBuilder->create(AddresForm::class),
                'wrapper' => false,
                'wrapper_class' => false,
                'label'=>'Endereço',
            ])
            ->addDescription()
            ->getStatus("Ativo", "Inativo")
            ->addSubmit();

        parent::buildForm();
    }

}
