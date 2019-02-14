<?php 

return [
    /*
    |--------------------------------------------------------------------------
    | Max Age 
    |--------------------------------------------------------------------------
    |
    | Máximo de edades Permitida por Happy Feet Sur
    |
    */

    'max-age' => 10,
    
    
    /*
    |--------------------------------------------------------------------------
    | Group Names
    |--------------------------------------------------------------------------
    |
    | Nombre de los grupos existentes
    |
    */

    'group-names' => [
        str_slug('Little Toes') => 'Little Toes',
        str_slug('Big Toes') => 'Big Toes',
        str_slug('HappyFeet') => 'HappyFeet',
        str_slug('HappyFeet Avanzado') => 'HappyFeet Avanzado',
    ],
    
    
    /*
    |--------------------------------------------------------------------------
    | Max Group Capacity
    |--------------------------------------------------------------------------
    |
    | capacidad máxima de un grupo
    |
    */

    'group-max-num' => 15,
    
    
    /*
    |--------------------------------------------------------------------------
    | Max Group Capacity
    |--------------------------------------------------------------------------
    |
    | capacidad máxima de un grupo
    |
    */

    'class-types' => [
        1 => 'Demostrativa',
        2 => 'Pagada'
    ]

];
