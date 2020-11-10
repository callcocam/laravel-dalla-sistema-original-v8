<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Common;

use App\Models\Admin\Company;
use App\User;
use App\Models\Admin\File;
use Illuminate\Database\Query\Builder;

trait Select
{

    protected $source;


    public function author()
    {
        $user = $this->user()->first();
        if($user){
            $user->append('avatar');
            $user->append('created_mm_dd_yyyy');
        }

        return $user;
    }


    public function user()
    {

        return $this->belongsTo(User::class);
    }


    /**
     * @return File
     */
    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }



    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getQuery()
    {

        return parent::query();
    }

    public function getSources()
    {
        if (!$this->source) {
            $this->source = $this->query();
        }
        return $this->source;
    }
    public function findById($id, $columns = ['*'])
    {

        $result = $this->where([
            'id' => $id
        ])->first($columns);

        if ($result) {

            return $result;
        }
        return FALSE;
    }

    public function findAll($columns = ['*'])
    {
        return parent::all($columns);
    }

    public function findBy($where, $columns =["*"])
    {

        $result = $this->select($columns)->where($where);

        if ($result) {
            /**
             * @var $result Builder
             */
            return $result;
        }
        return FALSE;
    }



}
