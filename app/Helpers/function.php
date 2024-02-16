<?php
function routeActive($name)
{
    return request()->is('admin/' . $name . '/*') || request()->is('admin/' . $name);
}


function menuActive($name)
{
    return request()->is($name);
}
