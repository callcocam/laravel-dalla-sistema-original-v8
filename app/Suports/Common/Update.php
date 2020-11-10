<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Common;


use App\AbstractModel;

trait Update
{
    public function updateBy(&$input,$id){
        array_push($this->fillable,'updated_at');
        $this->results['type'] = Options::MESSAGE_TYPE_ERROR;
        $this->results['result'] = false;
        $this->results['title'] = Options::DEFAULT_MESSAGE_TITLE;
        $this->results['table'] = $this->table;

        /**
         * @var $model AbstractModel
         */
        $model = $this->find($id);

        $data =[];
        
        foreach ($this->fillable as $value):           
            try{                
                
                    $data[$value] = $input[$value];

            }catch (\Exception $e){}
        endforeach;


        if(!$model):
            $this->messages = "Falhou, não foi possivel atualizar o registro, modelo não foi encontrado!!";
            return false;

        endif;

        unset($data['created_at']);

        $model->fill($data);

        if(!$model->save()):

            $this->messages = "Falhou, não foi possivel atualizar o registro!!";

            return false;

        endif;

        $this->model =  $this->findById($id);

        $input = array_merge($input, $this->model->toArray());

        $this->lastId =  $id;

        $message = sprintf( 'Realizada com sucesso, registro [ %s ] foi atualizado com sucesso!!', isset($input[Options::DEFAULT_COLUMN_SLUG_ORIGEM])?$input[Options::DEFAULT_COLUMN_SLUG_ORIGEM]:$this->lastId);

        $this->results['id'] =  $id;
        $this->results['result'] =  true;
        $this->messages = $message;

        return true;

    }
}
