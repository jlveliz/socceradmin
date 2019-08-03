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

if(!function_exists('num_days_of_week')) {
    
    function num_days_of_week () {
        return [ 
            'monday' => 1 ,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6,
            'sunday' => 7,
        ];
    }
}


if(!function_exists('range_ages')) {

    function range_ages() {
        $range = [];
        for ($i=1; $i <= config('Futbol.max-age'); $i++) { 
            $range[$i] = $i; 
        }
        return $range;
    }

}


if(!function_exists('get_group_names')) {
    
    function get_group_names () {
        return config('Futbol.group-names');
    }

}


if(!function_exists('get_states')) {
    
    function get_states () {
        return [
            1 => 'Activo',
            0 => 'Inactivo'
        ];
    }

}


if(!function_exists('get_durations_string')) {
    
    function get_durations_string () {
        return [
            'Mes(s)',
            'Año(s)'
        ];
    }

}



if(!function_exists('get_type_class')) {
    
    function get_type_class () {
        return config('futbol.class-types');
    }

}

if(!function_exists('month_of_year')) {
    
    function month_of_year () {
        return [
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];
    }

}