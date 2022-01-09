<?php

//*************for active link menu in sidebar*********
//for parent
function getParentShowOf($param){
    $route = str_replace('admin.','',$param);
    $permission =  \Illuminate\Support\Facades\Cache::get('admin_side_menu')->where('as',$route)->first();
    return $permission ? $permission->parent_show : $route;
}
//for children
function getChildrenShowOf($param){
    $route = str_replace('admin.','',$param);
    $permission =  \Illuminate\Support\Facades\Cache::get('admin_side_menu')->where('as',$route)->first();
    return $permission ? $permission->parent : $route;
}

//for children id
function getChildrenIdShowOf($param){
    $route = str_replace('admin.','',$param);
    $permission =  \Illuminate\Support\Facades\Cache::get('admin_side_menu')->where('as',$route)->first();
    return $permission ? $permission->id : null;
}
