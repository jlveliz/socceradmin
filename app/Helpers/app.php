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


if(!function_exists('range_ages')) {

    function range_ages() {
        $range = [];
        for ($i=1; $i <= config('happyfeet.max-age'); $i++) { 
            $range[$i] = $i; 
        }
        return $range;
    }

}