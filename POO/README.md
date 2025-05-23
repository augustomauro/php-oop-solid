Ref: https://www.youtube.com/watch?v=SI7O81GMG2A&ab_channel=BitBoss

## POO

La programacion orientada a objeta se basa en crear tipos nuevos de datos a los que llamaremos Objetos.
Para ello trataremos a nuestro codigo como un modulo con 2 partes, Propiedades y Funciones.
A los datos los llamaremos Atributos y a las Funciones, Metodos.
Los atributos son las propiedades que definen al objeto y los metodos las acciones que pueden realizar.
Por ejemplo para una Taza, los atributos que son importantes para nosotros pueden ser el volumen total 
de la taza, el liquido con el que esté llena y la cantidad de ese liquido.
Los metodos pueden ser llenar(), beber() o vaciar().

Para especificar que queremos crear un tipo de dato nuevo, se usa la clase.
La clase es la plantilla donde definiremos los atributos y los metodos.
Con esta plantilla se pueden crear objetos de ese tipo, dandole valores a sus atributos,
esto es conocido como INSTANCIAR.
Para instanciarlo se hace uso del metodo constructor(), un metodo que sirve para crear el objeto
y darle valores necesarios para iniciarlo.

Clase Taza                              objeto Taza
|-volumen | -------constructor------->  150
|-liquido |                             cafe
|-cantidad|                             100
+---------+                             objeto Taza
|+llenar()|                             250
|+beber() |                             te
|+vaciar()|                             200
+---------+

El nombre del metodo contructor depende del lenguaje que estemos utilizando, 
como init en Phyton o con el mismo nombre en Java, pero eso lo veremos mas adelante
en otro video dedicado al lenguaje.

Una vez instanciar el objeto, se podra acceder a sus atributos para modificarlo, leerlos
o llamar a sus metodos.

---

## Abstraccion

Cuando nosotros hacemos una clase tenemos que seleccionar los atributos y metodos que va a tener.
Si queremos definir que es una Cancion, no es necesario incluir todas las caracteristicas,
tenemos que ABSTRAERNOS, añadiendo solo las necesarias para el objetivo que tengamos planeado.
Por ejemplo si nuestro objetivo es hacer una biblioteca de musica, los atributos pueden ser el nombre,
el artista, la duracion y el genero, como metodos pueden ser escuchar() y el constructor().
En cambio si el objetivo es usarlo como base de datos para una pagina de ventas, los atributos 
pueden ser el nombre, el artista y el precio, como metodos pueden ser comprar() y el contrsuctor().
Con la abstraccion, elegimos cuales seran los atributos y los metodos que definiran qué es una Cancion
para nosotros.

 Cancion
|-nombre      |
|-artista     |
|-duracion    |
|-genero      |
+-------------+
|+escuchar()  |
|+contructor()|
+-------------+

 Cancion
|-nombre      |
|-artista     |
|-precio      |
+-------------+
|+comprar()   |
|+contructor()|
+-------------+

Otro ejemplo es un personaje para un juego. Necesito un nombre, estadisticas de fuerza, inteligencia,
defensa, una cantidad de vida, la posicion donde esta y un contador de acciones que pueda realizar.
Sus metodos pueden ser atacar(), moverse(), y turno(). Añadiremos el contructor y listo.
Esta clase nos viene muy bien para el siguiente pilar, la Encapsulacion.

---

## Encapsulacion

Nosotros podemos hacer un prorama por medio de varias clases que se comuniquen entre si, a esto se le llama 
Modularidad. Es bastante util, si falla algo en nuestro programa es bastante mas facil de detectar donde y que
debemos arreglar. 

    Control -> Personaje -> Enemigo -> Evento

Cada clase debe tener control propio de lo que sucede dentro de ella y tener los metodos
adecuados para poder ser utilizada desde afuera. Si nosotros usamos un punto con nuestra clase personaje,
podriamos tener acceso a todos los atributos y metodos que contiene, lo cual puede ser peligroso, porque
podriamos alterar su comportamiento interno.
Para solucionarlo podemos declarar cuales de nuestros atributos y metodos van a ser privados y cuales publicos.
Esto es lo que se conoce como ENCAPSULACION.

Por ejemplo, para nuestra clase Personaje, queremos que entre sus 4 metodos, solo sea accesible el constructor()
y turno() que gestiona la funcionalidad de la clase.
Turno() dependiendo del atributo contador y de los deseos del usuario, controla las acciones de atacar() y moverse()
gastando contadores cada vez que se usen, si no hay contadores, el metodo termina.
Como turno() es quien controla la ejecucion de los metodos atacar() y moverse(), estos 2 deben ser privados, ya que
no queremos que estos metodos se ejecuten desde fuera sin ser gestionados por turno().
Desde fuera no serian accesibles a traves del punto, evitando que se pudiera atacar o moverse sin restar contadores,
pero turno() al estar dentro de la clase sí los podria usar.

Al igual que con los metodos, se puede hacer lo mismo con los atributos. Podemos crear metodos de acceso y modificacion
de los atributos. Dentro de estos metodos podemos tener control sobre ellos.
Estos metodos se suelen nombrar anteponiendo la palabra "get" para acceder y "set" para modificar, ejemplo:

    getNombre(), setNombre(), getFuerza(), setFuerza(), getInteligencia(), setInteligencia(), getDefensa(), setDefensa()

Por ejemplo nosotros queremos que contador pueda consultarse y modificarse desde fuera, ya que es importante para que

funcione turno(), pero no queremos que se introduzca un numero negativo. Dentro del metod setContador() podemos incluir
una validacion para tal fin, para que no modifique el valor e informe de tal fallo.

---

## Herencia

Ahora quermos crear la clase Guerrero y Mago que tienen todos los atributos y metodos que tiene nuestra clase Personaje,
mas algunos atributos y metodos nuevos. En vez de crear todo de nuevo, podemos reutilizar la clase Personaje con la Herencia.
Tanto la clase Guerrero como Mago, heredaran de clase Personaje todos sus atributos y metodos, y ya solo nos quedaria añadir los nuevos.
A la clase que hereda se la conoce como clase Padre o Superclase a la clase heredada se la conoce como Hija o subclase.

---

## Polimorfismo

Esto permite a un metodo ser diferente segun que clase lo este usando. Es decir, puede tener muchas formas de usarse.
Volviendo al ejemplo del Personaje, el Guerrero y el Mago, las 3 clases tienen el metodo atacar() que realizan la misma accion,
tienen el mismo codigo, pero despues de la herencia podemos volver a definir los metodos heredados, por ejemplo podemos cambiar
la funcionalidad del metodo atacar(). Personaje usaba la estadistica fuerza para atacar con las manos, pero queremos que el metodo
atacar de la clase Guerrero, haga otra cosa, como incrementar el daño a partir del arma que use, o por ejemplo que la clase Mago
pueda atacar al usar libros por medio de la estadistica de la inteligencia.
Esta ventaja se puede aprvechar sobre todo en lenguajes fuertemente tipados como JAVA, donde hay que declarar el tipo de la variable.
Al crear una variable de tipo Personaje, no podria recibir un objeto tipo Cancion, solo un objeto tipo Personaje o que herede de él.
Si nosotros justo despues llamamos al metodo atacar() para calcular cuanto daño ha realizado, segun que clase reciba lo calculara
de distintas formas.
Esto es muy util ya que asi se puede crear una funcion que calcule el daño independientemente de que clase reciba.

    public Integer daño(Personaje jugador) {
        return jugador.atacar();
    }

Si no utilizamos polimorfismo por herencia, tendriamos que hacer una funcion diferente por cada clase.

-----------------------------------------------------

Ref: https://www.youtube.com/watch?v=Bj2ta9xv4cM&ab_channel=CharlyCimino

### Interfaz o Clase Abstracta?

Si bien no hay un cuando usar una u otra, mas bien dependera del contexto, veamos algunos ejemplos:

    Murcielago, Dron, Bicicleta

En principio Murcielago y Dron comparten una misma accion, la de volar, entonces definiremos una clase abstracta con un metodo
abstracto llamado volar():

    Abstract Class Volador
    -algunAtributo
    +volar():void
    +algunMetodoComun():

Cada clase, tanto Murcielago como Dron deberan implementar el metodo volar() como corresponda.
Visto que esta clase asbtracta contiene atributos y algun otro metodo compartido, debera declrarse como Clase Abstracta,
ya que una interfaz NO PERMITE tener atributos en si, solo define contratos de metodos comunes que deberan luego ser declarados
si o si donde se implementen. Esa es la diferencia principal de uso de una u otra.

Ahora si solo quedara definido un metodo especifico comun como volar(), entonces ahi si podemos decidir si utilizar
una interfaz:

    Interface Volador
    +volar():void

Ahora la palabra reservada "extends" solo admite una Super Clase, por lo cual si necesitaramos ademas consumir metodos de otra clase
no podriamos hacerlo y debemos utilizar otras formas.

Supongamos que ahora queremos modelar la familia de los mamiferos, de donde proviene el Murcielago, se sabe que todos los mamiferos
deben contener una mandibula y suponiendo que Volador aun es abstracta:

    Murcielago extends Volador {}

Esto ya limita a que Murcielago pueda tener otra Super clase y herede de Mamifero, entonces Volador conviene que sea una interfaz:

    Murcielago extends Mamifero implements Volador {}

Entonces al ver que Volador refiere mas bien a una accion de que peude hacer el objeto, en este caso volar, y la clase Mamifero
define mas bien el tipo de objeto, ahi si consideramos separarlos y decir que Mamifero es una clase abstracta y Volador una interfaz.

El dron tambien compartira el mismo comportamiento Volador. Asi mismo el Dron comparte el tipo Vehiculo que sera abstracta, como tambien
podra compartirla la clase Bicicleta. Tambien BicicletaElectrica comparte de la clase Bicilceta aunque tiene algunos atributos particulares
como un motor electrico y algo mas, distinto a una bicicleta mecanica. En este caso entonces BicicletaElectrica extiende de Bicicleta, 
ya que como dijimos comparten caracteristicas o tipos q la definen y no metodos o acciones en si como lo haria normalmente una interfaz.
Con esto entonces podemos decir que una clase de comportamiento como Recargable, no podria ser compartida con la clase Bicicleta (a secas),
pero si con BicicletaElectrica, quien en ese caso implementaria la clase Recargable.
Tambien los Drones pueden implementar la clase Recargable, asi como Tablet implementa Recargable.
Las interfaces entonces solo definen acciones o metodos y siendo asi de sencillas es que una clase hija puede implementar mas de una interfaz,
cosa que no puede hacer extendiendo de una superclase que solo puede hacerlo UNA UNICA VEZ.

Pensando todas estas combinaciones es que el software puede crecer sin modificar mucho, mas bien reutilizando interfaces o extendiendo de clases
abstractas cuando sea conveniente.

    Murcielago extends Mamifero implements Volador {}
    Bicicleta extends Vehiculo {}
    BicicletaElectrica extends Bicicleta implements Recargable {}
    Tablet implements Recargable {}

    Dron extends Vehiculo implements Volador, Recargable {
        @override
        public void volar() {
            System.out.printIn('Giro mis helices');
        }

        @override
        public void recargar() {
            System.out.printIn('Recargo mis baterias');
        }
    }

Importante: cada vez que una clase implemente una clase estara obligada a declarar como implemetar TODOS los metodos que alli esten declarados.

En PHP NO SE ADMITE la herencia multiple, es decir, solo se puede extender de una UNICA clase padre. No asi en C++ or ejemplo.
En PHP para emular este comportamiento es que se utilizan los Traits.

---