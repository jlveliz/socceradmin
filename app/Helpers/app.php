<?php 

if(!function_exists('days_of_week')) {
    
    function days_of_week () {
        return [ 
            'monday' => 'Lunes',
            'tuesday' =>'Martes',
            'wednesday' => 'Miércoles',
            'thursday' => 'Jueves',
            'friday' => 'Viernes',
            'saturday' => 'Sábado',
            'sunday' => 'Domingo',
        ];
    }
}