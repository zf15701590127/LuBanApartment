<?php

// 生成不同页面的不同页面类名称
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
