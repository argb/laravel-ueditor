<?php

/**
 * Your package routes would go here
 */

$routeName=config('ueditor.upload_route');
$middleware=config('ueditor.core.route.middleware');
Route::any($routeName,['middleware'=> $middleware,'uses'=>'Ender\UEditor\UEditorController@server']);