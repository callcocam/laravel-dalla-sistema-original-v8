<?php

namespace App\Forms;

use App\AbstractForm;
use App\Models\Admin\Category;

class DownloadForm extends AbstractForm
{
    public function buildForm()
    {
        $this ->add('id', 'hidden')
            ->add('slug', 'hidden')
            ->add('category_id', 'entity',[
                'class' => Category::class,
                'empty_value' => '=== Selecione Uma Categoria ==='
            ])
            ->add('name', 'text',
                [
                    'label'=>'Nome'
                ]
            )
            ->add('cover', 'file',
                [
                    'label'=>'Selecione uma imagem'
                ]
            )
//            ->add('file', 'file',
//                [
//                    'label'=>'Selecione um arquivo'
//                ]
//            )
            ->addDescription()
            ->getStatus()
            ->addSubmit();

        parent::buildForm();
    }
}
