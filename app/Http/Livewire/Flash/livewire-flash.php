<?php

return [
    'views' => [
        'container' => 'livewire-flash::flash-container',
        'message'   => 'livewire-flash::flash-message',
        'overlay'   => 'livewire-flash::flash-overlay',
    ],
    'styles' => [
        'info' => [
            'bg-color'     => 'info',
            'border-color' => 'border-blue-400',
            'icon-color'   => 'text-blue-400',
            'text-color'   => 'text-blue-800',
            'icon'         => 'fas fa-info-circle',
        ],
        'success' => [
            'bg-color'     => 'success',
            'border-color' => 'border-green-400',
            'icon-color'   => 'text-green-400',
            'text-color'   => 'text-green-800',
            'icon'         => 'fas fa-check',
        ],
        'warning' => [
            'bg-color'     => 'warning',
            'border-color' => 'border-yellow-400',
            'icon-color'   => 'text-yellow-400',
            'text-color'   => 'text-yellow-800',
            'icon'         => 'fas fa-exclamation-circle',
        ],
        'error' => [
            'bg-color'     => 'danger',
            'border-color' => 'border-red-400',
            'icon-color'   => 'text-red-400',
            'text-color'   => 'text-red-800',
            'icon'         => 'fas fa-exclamation-triangle',
        ],
        'overlay' => [
            'overly-bg-color' => 'warning',
            'overlay-bg-opacity' => 'opacity-75',

            'title-text-color' => 'black',

            'body-text-color' => 'black',

            'button-border-color' => 'border-transparent',
            'button-bg-color' => 'bg-indigo-600',
            'button-text-color' => 'text-white',

            'button-hover-bg-color' => 'hover:bg-indigo-700',
            'button-hover-text-color' => 'hover:text-white',
            'button-focus-ring-color' => 'focus:ring-indigo-500',

            'button-extra-classes' => '',

            'button-text' => 'Fechar',
        ],
    ],
];
