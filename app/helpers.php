<?php

  

function to_nc($value){
    return strlen($value) == 0 ? 'N/C' : $value;
}