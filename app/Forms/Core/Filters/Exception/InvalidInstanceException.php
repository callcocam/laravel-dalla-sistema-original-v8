<?php

namespace App\Forms\Core\Filters\Exception;

use App\Forms\Core\Filters\FilterInterface;
use Throwable;

/**
 * Class InvalidInstanceException
 *
 * @package App\Forms\Core\Filters\Exception
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 */
class InvalidInstanceException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Filter object must implement ' . FilterInterface::class;
        parent::__construct($message, $code, $previous);
    }
}
