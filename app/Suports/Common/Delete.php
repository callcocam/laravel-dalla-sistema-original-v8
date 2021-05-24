<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Common;



use App\AbstractModel;

trait Delete
{
    public function deleteBy($model)
    {

           if ($model) {
            if ($model->delete()) {
                $this->results['title'] = 'Operação:';
                $this->results['result'] = true;
                $this->results['table'] = $this->table;
                $this->results['type'] = 'is-danger';
                $this->messages = sprintf("Realizada com sucesso, registro - %s - foi excluido com sucesso!!", $model->id);

                return true;
            }
        }
        $this->results['title'] = 'Operação:';
        $this->results['result'] = false;
        $this->results['table'] = $this->table;
        $this->results['type'] = 'is-danger';
        $this->messages = sprintf("Falhou, não foi possivel encontrar o registro - %s!!", $model->id);

        return false;
    }


    public function deleteAll($data)
    {
        /**
         * @var AbstractModel
         */
        $model = $this->query()->whereIn('id', $data);

        if ($model) {
            $this->results = [
                'model' => $model->delete()
            ];
            $this->messages = "Realizada com sucesso, registros foram excluido com sucesso!!";
            return true;
        }

        $this->results = [
            'tabla' => $this->table,
        ];
        $this->messages = "Falhou, não foi possivel encontrar o(s) registro(s)!!";
        return false;
    }
}
