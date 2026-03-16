<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Configuration
    |--------------------------------------------------------------------------
    |
    | Configurazione per il sistema di gestione immagini
    |
    */

    // Dimensioni predefinite per le immagini
    'dimensions' => [
        'standard' => [
            'width' => 300,
            'height' => 300,
            'mode' => 'cover', // cover = ritaglia, contain = mantiene proporzioni
            'quality' => 85,
        ],
    ],

    // Percorsi di storage
    'paths' => [
        'original' => 'images/original',
        'processed' => 'images/processed',
    ],

    // Tipi di file permessi
    'allowed_types' => [
        'image/jpeg',
        'image/png',
        'image/webp',
    ],

    // Limiti
    'limits' => [
        'max_file_size' => 5120, // KB (5MB)
        'min_width' => 200,
        'min_height' => 200,
        'max_width' => 4096,
        'max_height' => 4096,
    ],
];
