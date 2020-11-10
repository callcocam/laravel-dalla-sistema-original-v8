<?php

namespace App\Forms\Core\Filters\Collection;

use App\Forms\Core\Filters\FilterInterface;

/**
 * Class StripNewlines
 *
 * @package App\Forms\Core\Filters\Collection
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 */
class StripNewlines implements FilterInterface
{
    /**
     * @param  mixed $value
     * @param  array $options
     *
     * @return mixed
     */
    public function filter($value, $options = [])
    {
        return str_replace(["\n", "\r"], '', $value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'StripNewlines';
    }
}
