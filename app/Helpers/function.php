<?php
//Admin
function routeActive($name)
{
    return request()->is('admin/' . $name . '/*') || request()->is('admin/' . $name);
}


function menuActive($name)
{
    return request()->is($name);
}


function isRole($data, $module, $name = 'view')
{
    if (!empty($data[$module])) {
        if (!empty($data[$module]) && in_array($name, $data[$module])) {
            return true;
        }
    }
    return false;
}

function isPower($data, $value)
{
    if (!empty($data)) {
        if (!empty($data) && in_array($value, $data)) {
            return true;
        }
    }
    return false;
}

//Client
