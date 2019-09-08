<?php

/**
 * 将当前请求的路由名称转化成CSS类名称
 * @return mixed
 */
function route_class(){
    return str_replace('.','-',Route::currentRouteName());
}
