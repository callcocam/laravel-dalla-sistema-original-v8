<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Company extends AbstractModel
{
    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'document', 'updated_at',
    ];
    protected $appends = ['pontos'];

    public function address()
    {

        return $this->morphOne(Addres::class, 'addresable');
    }

    public function orders($status = 'open')
    {

        if (auth()->user()->hasAnyRole('cliente')) {
            return $this->hasMany(Order::class)->latest()->where('status', $status)->where('client_id', auth()->id())->limit(5)->get();
        }
        return $this->hasMany(Order::class)->where('status', $status)->limit(5)->get();
    }

    public function saveBy($data)
    {
        $result = parent::saveBy($data);
        if (isset($data['pontos'])) {

            if ($score_metas = $this->model->pontos()->first()) {
                $score_metas->update($data['pontos']);
            } else {
                $this->model->pontos()->create($data['pontos']);
            }
        }
        return $result;
    }

    public function counts($table)
    {
        if (auth()->user()->hasAnyRole('cliente')) {
            return DB::table($table)->whereNull('deleted_at')->where('client_id', auth()->id())->count();
        }
        return DB::table($table)->whereNull('deleted_at')->count();
    }

    public function pontos()
    {

        return $this->hasOne(ScoreMata::class);
    }

    public function getPontosAttribute()
    {

        $pontos = $this->pontos()->first();
        if ($pontos)
            return $pontos->toArray();

        return [];
    }
}
