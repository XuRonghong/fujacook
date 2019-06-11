<?php

if ( !function_exists('set_active')) {
    function set_active($path, $active = 'active', $not_path = []) {

        if($not_path)
        {
            if(call_user_func_array('Request::is', (array)$not_path)) return '';
        }

        return call_user_func_array('Request::is', (array)$path) ? $active : '';

    }
}

if ( !function_exists('search')) {
    function search($column){
        foreach ($column as  $col) {
            if(Request::filled($col))
                return 'in';
        }
        return	'';
    }
}
