<?php
$app->get('/','App\Controllers\HomeController:index');
$app->get('/laptop','App\Controllers\LaptopController:index');
$app->get('/admin','App\Controllers\LaptopController:admin')->setName('admin');
$app->get('/admin/add','App\Controllers\LaptopController:getAdd');
$app->get('/admin/edit/{id}','App\Controllers\LaptopController:getEdit');
$app->get('/admin/delete/{id}','App\Controllers\LaptopController:softDelete');
$app->post('/admin/add','App\Controllers\LaptopController:add')->setName('add');
