<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


$routeFiles = glob(__DIR__ . '/splitted_routes/*.php');

foreach ($routeFiles as $routeFile) {
    require $routeFile;
}