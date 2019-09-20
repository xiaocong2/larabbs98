<?php

/**
 * 将当前请求的路由名称转化成CSS类名称
 * @return mixed
 */
function route_class(){
    return str_replace('.','-',Route::currentRouteName());
}

/**
 * 判断选中栏目
 * @param $category_id
 * @return string
 */
function category_nav_active($category_id){
    return active_class((if_route('categories.show') && if_route_param('category',$category_id)));
}

/**
 * 截取文章摘要
 * @param $value
 * @param int $length
 * @return string
 */
function make_excerpt($value,$length = 200){
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}
