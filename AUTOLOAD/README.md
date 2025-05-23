# AUTOLOAD

## Que es?

Imaginemos una aplicacion organizada por carpetas como App\Controllers, App\Models
y otras. Imaginemos que la app va creciendo y hay que ir importando de a uno los archivos nuevos que se vayan creando, tanto en Models como en Controllers.

A fin de evitar importar cada clase de a una, en PHP se utiliza una funcion que detecta el archivo por el nombre de la clase, resolviendo esto de forma automatica:

    App\Controlles\CourseController.php
    App\Models\Course.php
    index.php

Donde en index.php:

```php
<?php
    require_once 'App/Controllers/CourseControllers.php';
    require_once 'App/Models/Course.php';
```

y asi cada vez que se agregue algun nuevo archivo.

Modificamos index.php para resovlerlo de forma automatica:

```php
<?php

    use App\Controllers\CourseController;
    use App\Models\Course;

    spl_autoload_register(function($clase){
        echo $clase;
    });

    $course = new Course;
```

Nota: esto imprimira el texto "App\Models\Course" pero dara un error al no haberse
requerido aun el archivo en cuestion.

Entonces primero, reemplazamos el caracter especial "\" por "/" para poder hacer require:

```php
<?php require_once str_replace('\\', '/', $clase) . '.php'; >
```

Tambien agregamos una validacion para saber si el archivo existe o no antes de importar, quedando:

```php
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
```

---