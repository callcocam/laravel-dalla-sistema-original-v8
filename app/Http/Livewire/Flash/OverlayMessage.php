<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Http\Livewire\Flash;

class OverlayMessage extends Message
{
    /**
     * The title of the message.
     *
     * @var string
     */
    public $title = null;

    /**
     * Whether the message is an overlay.
     *
     * @var bool
     */
    public $overlay = true;
}
