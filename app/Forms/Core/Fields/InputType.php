<?php

namespace  App\Forms\Core\Fields;

class InputType extends FormField
{

    /**
     * @inheritdoc
     */
    protected function getTemplate()
    {
        return 'text';
    }

}
