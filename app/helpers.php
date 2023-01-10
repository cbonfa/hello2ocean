<?php

function to_nc($value){
    return strlen($value) == 0 ? 'N/C' : $value;
}


function to_sn($value){
    return $value ? __('Yes') : __('No');
}