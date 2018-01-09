<?php

function admin() {
  return \Auth::guard('admin')->user();
}

function user() {
  return \Auth::guard()->user();
}
function admins(){
    return App\Models\User::admins()->get();
}
function userTypeIds(){
    return App\Models\Management\UserType::all()->implode('id',',');
}
function userTypes(){
    return App\Models\Management\UserType::all();
}
function multiselect($collection, $fields, $key = 'id'){
    return \App\Helpers\Widget::multiselect($collection,$fields,$key);
}
function userAllTypes() {
    $user_types = [];
    foreach (App\Models\Management\UserType::all() as $value) {
        $user_types[$value->id] = $value->descrip;
    }
    return $user_types;
}