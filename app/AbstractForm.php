<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */


namespace App;


use App\Suports\Shinobi\Models\Permission;
use App\Suports\Shinobi\Models\Role;
use Illuminate\Support\Str;
use App\Forms\Core\Form;

abstract class AbstractForm extends Form
{
    /**
     * @var Permission
     */
    protected $permission;
    /**
     * @var Role
     */
    protected $role;

    public function buildForm()
    {


    }
    protected function getStatus($published="Publicado", $draft="Rascunho"){

        return $this->add('status', 'choice',[
            'choices'=>[
                'published'=>$published,
                'draft'=>$draft,
            ],
            'label'=>'Situação',
            'expanded'=>true,
        ]);

    }
protected function addDescription($name="description",$label="Descrição", $attr =[]){

        return $this->add($name, 'textarea', [
            'label'=>$label,
            'attr'=>array_merge([
                'rows'=>'5'
            ], $attr)
        ]);

    }

    protected function addSubmit($label = "Salvar Dados", $options = [], $attr = []){

        return  $this->add('submit', 'submit', array_merge(
            [
                'label' => $label,
                'name' => Str::slug($label),
                'attr'=>array_merge([
                    'class'=>'btn btn-primary btn-block btn-rounded'
                ], $attr)]
            , $options));

    }

}
/* ->add('languages', 'entity', [
                'class' => Permission::class,
                //'property' => 'name',
                //'property_key ' => 'id',
                'query_builder' => function (Permission $permission) {
                    // If query builder option is not provided, all data is fetched
                    return $permission->where('status', 'published');
                }
            ])*/
