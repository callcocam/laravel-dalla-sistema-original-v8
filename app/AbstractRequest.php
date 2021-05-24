<?php


namespace App;


use Illuminate\Http\Request;

abstract class AbstractRequest extends Request
{

    /**
     * @return array
     */
    abstract public function getRules():array ;

}
