<?php
return [
    'alumno' => [
        'nombre' => [
            'max' => 100,
            'type' => 'string',
        ],
        'ap_paterno' => [
            'max' => 100,
            'type' => 'string',
        ],
        'ap_materno' => [
            'max' => 100,
            'type' => 'string',
        ],
        'matricula' => [
            'max' => 15,
            'type' => 'string',
        ],
        'email' => [
            'max' => 255,
            'type' => 'email',
        ],
        'telefono' => [
            'max' => 15,
            'type' => 'string',
        ],
        'password' => [
            'max' => 255,
            'type' => 'string',
        ],
    ]
]
?>
