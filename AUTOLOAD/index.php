<?php

use App\Controllers\CourseController;
use App\Models\Course;

spl_autoload_register(function($clase){
    if (file_exists(str_replace('\\', '/', $clase) . '.php'))
        require_once str_replace('\\', '/', $clase) . '.php';
});

$course = new Course;
$course->saludar();

echo '<br>';

$courseController = new CourseController;
$courseController->saludar();