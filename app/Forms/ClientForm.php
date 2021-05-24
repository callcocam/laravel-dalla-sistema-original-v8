<?php

namespace App\Forms;

use App\AbstractForm;
use App\Suports\Shinobi\Models\Role;

class ClientForm extends AbstractForm
{
    public function buildForm()
    {
        if($this->getModel()){
            $this->add('id', 'hidden');
        }

        $role = Role::query()->where('slug','cliente')->first();

        $this
            ->add('role', 'hidden', [
                'value'=>$role->id
            ])
            ->add('is_admin', 'hidden', [
                'value'=>'0'
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
            ->addPassword()
            ->add('phone', 'tel',[
                'label'=>'Telefone'
            ])
            ->add('document', 'text',[
                'label'=>'Cpf/Cnpj'
            ])
            ->add('discount', 'text',[
                'label'=>'Desconto'
            ])
            ->add('barrels', 'text',[
                'label'=>'Barrils',
                'attr'=>[
                    'readonly'=>true,
                ]
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

    protected function addPassword(){

        if($this->getModel()){
            $this->getModel()->append('address');
        }

        return  $this->add('password', 'password',[
            'label'=>'Senha',
            'value'=>null
        ]);

    }
}
