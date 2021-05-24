<?php


namespace App\Forms\Fields;


use App\Forms\Core\Fields\FormField;

class LinkType extends FormField
{

    /**
     * Get the template, can be config variable or view path.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return 'laravel-form-builder::link';
    }



}
