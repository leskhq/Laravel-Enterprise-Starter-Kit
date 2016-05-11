<?php

return [
    'search' => [
        'smart'            => true,
        'case_insensitive' => true,
        'use_wildcards'    => false,
    ],

    'fractal' => [
        'serializer' => 'League\Fractal\Serializer\DataArraySerializer',
    ],

    'script_template' => 'datatables::script',
];
