# Qué son los objetos y cómo se crean

## La respuesta corta

En programación, un objeto es una unidad que encapsula estado y comportamiento.

## La respuesta larga

Cuando escribes un programa lo que haces es diseñar un modelo formal de una actividad o proceso. En esta actividad pueden manejarse ciertas entidades que, a medida que son sometidas a ciertos procedimientos, van cambiando su estado.

Eso que llamamos estado se concreta en una serie de propiedades o variables. Aunque los objetos modelan entidades o seres del mundo real eso no quiere decir que tengamos en cuenta todas sus propiedades, sino sólo las que son relevantes para los procesos que estamos modelando. Por ejemplo, en un sistema de gestión de alumnado para un colegio representaremos a los alumnos teniendo en cuenta aspectos como su nombre, su dirección postal, su fecha de nacimiento, etc, pero no tomaremos su estatura o peso y otras muchas de sus propiedades. Sin embargo, en un sistema para gestión de una consulta de pediatría sí que necesitamos llevar cuenta de su estatura y peso, entre otras variables.

Los procedimientos en que manipulamos las entidades modeladas determinan el comportamiento de los objetos. Volviendo a los ejemplos anteriores, en el sistema de gestión de alumnado nos interesan comportamientos como realizar un examen, recibir una calificación, llegar tarde, etc. En el sistema médico, por su parte, modelamos procesos como realizar una vacunación, sufrir una enfermedad, asignar y seguir un tratamiento, y un largo etcétera.

La discusión sobre qué entidades modelar, qué propiedades deben tener y qué comportamientos deben ejecutar, consituyen el meollo del diseño del sistema orientado a objetos.

Veamos un ejemplo.

Supongamos una biblioteca. En la biblioteca se gestionan libros, lo que implica adquirirlos, catalogarlos, prestarlos, devolverlos, enviarlos a restaurar, etc.

Cada libro es un objeto y tiene unas propiedades que lo definen, como el título o el autor (entre otras muchas), pero también estarían incluídas otras como si está disponible para préstamo, si está prestado o si ha sido retirado temporalmente para restauración. El conjunto de estas propiedades en un momento dado es el estado.

Por otra parte, con cada libro se dan una serie de procesos. Los libros son adquiridos por la biblioteca y catalogados. Una vez hecho esto están disponibles para el préstamo, así que los libros pueden ser prestados y devueltos. O bien, si el libro está en mal estado, debe ser enviado al restaurador.

En un programa representaríamos los libros con objetos que estarían constituidos de estado y comportamiento. El estado vendría representado por las propiedades del objeto, mientras que el comportamiento vendría definido por los métodos.

### Representando el mundo

Para representar un libro podríamos optar por varias estrategias en PHP.

	<?php 

	$aBookTitle = 'Don Qujote';
	$aBookAuthor = 'Miguel de Cervantes';
	$aBookAvailable = true;

	echo "El libro se titula ".$aBookTitle." y está escrito por ".$aBookAuthor;
	?>

Incluso los más novatos en PHP se darán cuenta de que ésta es una forma bastante ineficaz de trabajar. Necesitamos definir tres variables diferentes para poder trabajar con un libro. Tenemos que acordarnos siempre de las tres y no hay manera de obligarnos a mantenerlas juntas. Si volvemos a ver nuestro código después de unos días pasaremos un buen tiempo intentando entender cómo funciona ésto.

Afortundamante PHP ofrece una estructura de datos que podría encajar muy bien aquí: los arryas asociativos.

	<?php 

	$aBook = array(
	    'title' => 'Don Quijote',
	    'author' => 'Miguel de Cervantes',
	    'available' => true
	);

	echo "El libro se titula ".$aBook['title']." y está escrito por ".$aBook['author'];
	?>

Mucho mejor. Ahora sólo tenemos una variable y es fácil entender la organización de datos y sus relaciones. Incluso el acceso a cada propiedad del libro es sencillo.

Pero podemos ir mucho más allá. Con objetos no sólo mantenemos las propiedades juntas y describimos entidades del mundo real como conjuntos unitarios, sino que incluso podemos hacer que actúen, que tengan comportamiento y que hagan cosas.

### Objetos y propiedades

Pero vayamos por partes: las propiedades del objeto son como variables definidas dentro del ámbito del objeto y pueden adoptar cualquier tipo de valor soportado por el lenguaje de programación, incluyendo otros objetos.

En principio esto podría definirse en PHP así:

	<?php
	    class Book {
	        var $title;
	        var $author;
	        var $available;
	    }
	?>

Bien. Este código, como cualquier otro, es discutible, pero debería dejarnos claras algunas cosas y también plantearnos algunas preguntas.

Por ejemplo, ¿a qué viene eso de *class*?

Los objetos no salen de la nada, tienen que definirse en alguna parte. Para ello escribimos clases que son definiciones de la estructura de los objetos. En un programa utilizamos instancias de esa clase que hemos definido.

Para declarar una clase, utilizamos la palabra clave `class` y el nombre del objeto. Veremos más adelante que esta declaración puede tener algunos modificadores interesantes.

El cuerpo del objeto va entre llaves `{}`, como es habitual en la definición de bloques en PHP. Dentro del cuerpo definimos propiedades y definimos métodos.

Las propiedades del libro, que describen su estado, llevan la palabra clave `var` y su nombre. es posible no declarar las propiedades del objeto, ya que PHP es un lenguaje tipado dinámicamente, pero es una mala práctica. Lo mejor es declarar explícitamente las propiedades de la clase.

### Cómo se usa un objeto

Para usar un objeto debemos generar una instancia de la clase que deseemos. Así, por ejemplo, si queremos usar un libro en nuestro programa lo haremos así:

	<?php 

	class Book {
	    var $title;
	    var $author;
	    var $available;
	}
    
	$aBook = new Book();

	?>

Este código muestra cómo instanciar un objeto de la clase Book.

Instanciar es crear una variable del tipo de objeto deseado. La clave `new` le dice a PHP que cree un objeto de la clase Book en memoria y lo asocie a la variable `$aBook`.

¿Qué pasaría si añadimos una línea al código anterior y creamos otra instancia de Book?

	<?php 

	class Book {
	    var $title;
	    var $author;
	    var $available;
	}

	$aBook = new Book();
	$otherBook = new Book();

	?>

$otherBook es un objeto de la clase Book, o sea, de la misma clase que $aBook, pero es un objeto distinto. Ocupa diferente espacio en memoria. Aunque se usasen los mismos dato representan dos libros físicamente distintos, de la misma forma en que una biblioteca puede tener varios ejemplares de un mismo título.

Ahora bien. ¿Cómo asignamos valores a las propiedades del objeto?

Pues lo haríamos así:

	<?php 

	class Book {
	    var $title;
	    var $author;
	    var $available;
	}

	$aBook = new Book();
	$aBook->title = 'Don Quijote';
	$aBook->author = 'Miguel de Cervantes';
	$aBook->available = true;

	echo "El libro se titula ".$aBook->title." y está escrito por ".$aBook->author;

	?>

Por defecto, las propiedades del objeto declaradas con la palabra clave `var` son públicas, es decir, accesibles desde fuera del propio objeto y podemos asignarles valores y leerlos como se muestra en el código anterior.

### ¿Y esto de qué sirve?

Bien. Ya sabemos definir una clase con sus propiedades e instanciar un objeto a partir de la clase definida, pero no tenemos comportamientos ni parece que el objeto vaya a ser muy útil tal cual está, aparte de poder almacenar algunos datos.

En realidad, este tipo de objeto incluso tiene un nombre. Se trata de un **Data Transport Object** (Objeto de transporte de datos) o DTO. Resulta muy útil cuando necesitamos mover datos relacionados de una manera cómoda y rápida. Podríamos argumentar que un array asociativo hace lo mismo, pero pronto veremos que los objetos tienen varias ventajas.

## Visibilidad de las propiedades

Acabo de mencionar que las propiedades del objeto que acabamos de definir son públicas. Sin embargo, esto debería chirriarnos un poco. La programación orientada a objetos trata en gran medida de *ocultar la información* y la estructura y funcionamiento interno de los objetos. Estos son cajas negras para el resto del programa que sólo debería ver algunos métodos públicos.

Es como cuando contratas los servicios de cualquier profesional. Supongamos que se estropea tu nevera. Llamas al servicio técnico y una persona se desplaza a tu casa y la repara. Tú no tienes ni idea de lo que hace o cómo lo hace, simplemente le pides que repare tu nevera, le explicas los síntomas en los que notas que no funciona bien y esperas que te de una respuesta, la cual puede ser que tu nevera vuelve a funcionar correctamente o bien que ya no se puede reparar.

Como norma general, las propiedades de los objetos deben declararse privadas.

Esto se hace sustituyendo la declaración `var` por `private`.

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
	}

	$aBook = new Book();

	// A partir de aquí tendremos error

	$aBook->title = 'Don Quijote';
	$aBook->author = 'Miguel de Cervantes';
	$aBook->available = true;

	echo "El libro se titula ".$aBook->title." y está escrito por ".$aBook->author;

	?>

Nuestro nuevo código nos va a dar un error porque estaremos intentando acceder a una propiedad privada del objeto $aBook. Las propiedades privadas sólo están accesibles dentro del objeto en que están definidas. Pero entonces no tenemos modo de asignar ni obtener sus valores. Necesitamos métodos para ello. Los veremos dentro de un momento.

¿Por qué es tan importante ocultar las propiedades de los objetos?

Veamos el caso de los libros. Los libros llegan a una biblioteca una vez publicados, por lo que el título, el autor y otros datos no cambiarán nunca. En nuestro código eso se refleja haciendo que esas propiedades sean *inmutables*, lo que se logra:

* declarándolas privadas, de modo que no sean accesibles al mundo exterior.
* asignándolas en el momento de la instanciación del objeto, a través del llamado método constructor, el cual veremos a continuación.

Por otro lado, examinemos la propiedad available. Esa propiedad tiene que cambiar según sea necesario para indicar si el libro está disponible para préstamo o no. Sin embargo, puede que necesitemos realizar ciertas comprobaciones antes de cambiar su valor para asegurarnos de que realmente el libro está o no disponible. Además, si la propiedad es pública corremos el riesgo de que otra parte del programa la cambie de manera arbitraria, sin que se realicen las comprobaciones necesarias llevando a nuestro objeto libro a un estado inconsistente, como podría ser tenerlo disponible para préstamo cuando está siendo restaurado, por ejemplo.

## El constructor __construct()

El primer método que vamos a escribir es un constructor, que en PHP se declara con el nombre reservado `__construct` y que se invoca automáticamente cuando instanciamos un objeto con `new()`.

Los métodos de una clase se declaran igual que las funciones, con la diferencia de que se hace dentro del bloque de declaración de la clase.

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct() {
	    }
	}

	?>

Al igual que las funciones, podemos indicar argumentos en la signatura de la función, los cuales se pueden utilizar dentro del método. En nuestro caso, queremos pasar el título y el autor del libro, por lo que podemos escribir el siguiente código:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($title, $author) {
	        $this->title = $title;
	        $this->author = $author;
	    }
	}

	?>

Lo más llamativo de este método es la partícula `$this->`. Esta partícula indica que nos referimos a la propiedad con ese nombre del objeto. También usaremos `$this` para referirnos a los métodos. `$this` viene a significar "la instancia actual de la clase".

Volviendo al método, simplemente le pasamos los parámetros `$title` y `$author` y asignamos sus valores a las propiedades correspondientes. No hay ninguna razón técnica para que tengan los mismos nombres, pero preferimos hacerlo así por legibilidad. También podrías adopatar otra convención si crees que esta forma resulta ambígua. De paso, veremos cómo instanciar un objeto de la clase Book.

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthor) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');

	?>

Aparte de cambiar el nombre de los parámetros, hemos utilizado `new` para instanciar el objeto `$aBook`, que es de la clase Book. Para instanciar más objetos, o sea para tener más libros, usaríamos new pasándole los datos de los nuevos libros.

## Obetener el valor de propiedades privadas: getters

Ahora que nuestro libro ya puede tener título y autor se nos plantea el problema de acceder a esos valores. Es decir, hemos aprendido a asignar valores a las propiedades durante la construcción del objeto, pero ¿cómo accedo a esos valores si necesito consultarlos más adelante?

Para ello debemos escribir métodos que nos los devuelvan. A este tipo de métodos se les suele llamar *getters*: Veamos un ejemplo:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthor) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	    }
    
	    public function getTitle() {
	        return $this->title;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');
	echo $aBook->getTitle();

	?>

El método `getTitle` nos permite obtener el contenido de la propiedad `$title` del objeto. Como puedes ver las visibilidad del objeto es pública, para que pueda ser usado por nuestro programa y se limita a devolver el valor mediante return.

Obviamente un método puede ser más complejo y realizar operaciones diversas para generar un resultado determinado.

Algunos IDE permiten generar automáticamente métodos get\* para todas las propiedades de la clase. Sin embargo, hay muy buenas razones para no hacerlo. En realidad, sólo deberíamos crear métodos get\* para aquellas propiedades que queremos que se puedan consultar externamente. 

En nuestro caso, puede que nos interese poder acceder al título para generar listados de los libros utilizados por un lector determinado. Podría ser incluso que nunca necesitemos un método que nos devuelva sólo el autor, sino una cadena que combine título y autor. Todo esto depende, obviamente, de los casos de uso que queremos cubrir con nuestra aplicación. Veamos un ejemplo:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthor) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	    }
    
	    public function getTitle() {
	        return $this->title;
	    }
    
	    public function getAsReference() {
	        return $this->author.', '.$this->title;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');
	echo $aBook->getAsReference();

	?>

Una nota sobre los nombres de los métodos: deberían revelar las intenciones, o sea, el nombre del método debería indicar qué hace el método y qué podemos esperar de él. El nombre del método no debe reflejar el cómo lo hace.

## Propiedades que cambian

Hemos dejado sin tocar la propiedad `$available` para poder centrarnos en ella un momento. Con éste código podemos "construir" libros que tienen título y autor. Además, como no hay otros métodos que nos permitan acceder a esas propiedades, estos libros son "inmutables" al respecto de las mismas. Sin embargo, `$available` no queda definida (ahora mismo contiene `null`) por lo que tenemos un problema. ¿No sería mejor establecerla también en el constructor? La respuesta es un rotundo sí. 

El estado inicial del libro debería quedar correctamente establecido en el constructor. Esto es, al ejecutar el constructor, el objeto tiene que tener un estado válido, quedando todas las propiedades relevantes iniciadas a valores que sean válidos y con sentido para los propósitos de ese tipo de objetos. Podría haber propiedades no incializadas si eso tiene un significado o un sentido en la vida del objeto. Por ejemplo: la fecha del último préstamo, si consideramos que la clase Book debe gestionarla de algún modo, podría quedar definida aquí como `null` porque el hecho de que no esté definida indica que no ha sido prestada y no tiene sentido definirla hasta que el libro sea prestado.

Pero la propiedad `$available` sí necesita estar definida. Cuando un libro se añade al catálogo de la biblioteca, ¿debe estar ya disponible o todavía no? Esta es una decisión que hay que tomar para el caso que estamos trabajando: puede que tenga que estar disponible ya, puede que no porque hay que realizar otras operaciones o puede que haya que decidirlo en el momento de añadir el libro al catálogo. Veamos eso en código:

En este ejemplo se ha decidido que todos los libros están disponibles nada más darlos de alta:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthor) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	        $this->available = true;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');

	?>

Por otra parte, aquí se ha decidido lo contrario, y los libros no están disponibles hasta una decisión posterior:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthor) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	        $this->available = false;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');

	?>

Por último, en este código la decisión se toma en el momento de dar de alta el libro:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthor, $isAvailable) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	        $this->available = $isAvailable;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');

	?>

Como ya supondrás, la propiedad –$available– cambiará durante la vida del libro a medida que este sea prestado y devuelto. Tendremos que escribir un método para eso.

## Asignar valor a propiedades: setters.

Una primera forma de afrontar la cuestión es crear métodos que nos permitan asignar valores a propiedades. A los métodos cuyo propósito es asignar valores a una propiedad específica los llamamos *setters*. Para asignar valores a `$available`, podríamos hacer lo siguiente:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthore) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	        $this->available = false;
	    }
    
	    public function setAvailable($available) {
	        $this->available = $available;
	    }
    
	    public function getAvailable() {
	        return $this->available;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');
	$aBook->setAvailable(true);
	?>

Bien, ya tenemos un método para asignar un valor a –$available– y, de paso, hemos creado un método getter para poder consultarlo. Ahora bien, ¿qué ventaja presenta esto sobre hacer pública la propiedad `$available`? Pues la verdad es que ninguna. Estamos dejando que sea un factor externo el que controle el valor de la propiedad y hacerlo mediante getters y setters o mediante propiedades públicas es más o menos lo mismo.

Este tipo de planteamiento se suele conocer como **Anemic Domain Model**, o Modelo de Dominio Anémico (Fowler): un objeto sin comportamiento significativo que sólo tiene métodos para asignar o leer valores.

Planteémoslo de otra forma: ¿qué es lo que hace que un libro esté disponible o no? Pues un libro estará disponible siempre que:

* no esté prestado.
* no se haya retirado por restauracion.

Por lo tanto, al respecto de la propiedad –$available–, ¿qué acciones son importantes para nuestro libro?

* préstamo
* devolución
* restauración
* reposición

En el mundo real, el hecho de prestar un libro hace que no se encuentre disponible para nuevos préstamos ni, de hecho, para ninguna otra acción (salvo tal vez una reserva de préstamo, pero no nos vamos a ocupar de eso ahora). Cuando nos devuelven el libro, éste vuelve a estar disponible. Podemos reflejarlo así:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthor) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	        $this->available = false;
	    }
    
	    public function lend() {
	        if ($this->isAvailable()) {
	            $this->available = false;
	        }
	    }
    
	    public function getBack() {
	        $this->available = true;
	    }
    
	    private function isAvailable() {
	        return $this->available;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');
	$aBook->lend();
	if($aBook->isAvailable()) {
	    echo $aBook->title.' está disponible.'} 
	else {
	    echo $aBook->title.' está prestado o en restauración.'
	}
	?>

Hemos escrito métodos para prestar, devolver y conocer el estado de disponibilidad de un libro. Estos métodos trabajan todos con la propiedad `$available`, pero ahora es el propio objeto libro el responsable de ella. Los agentes externos usan el libro con acciones significativas, como lend (prestar), getBack (devolver) o isAvailable (preguntar si está disponible).

Aunque en el fondo actúan como setters y getters, su nombre nos indica "algo más". Nos indica qué hace el método de una manera significativa para nuestra aplicación.

Analicemos ahora cada método, antes de realizar unos cambios que los hagan aún mejores.

### El método lend

El método lend hace primero una comprobación: si el libro está disponible, entonces lo puede prestar. Al prestarlo tiene que poner la proviedad $available a false para indicar que ya no está disponible. Otra parte del programa puede ocuparse de recoger qué usuario se lleva el libro y cuál es el plazo de devolución. De momento, lo que necesitamos es manipular su disponiblidad.

Si el libro no está disponible no hace nada. Esto es insuficiente porque nosotros querríamos que el bibliotecario nos diga que no nos puede prestar el libro porque no está disponible, no queremos que simplemente no nos diga nada.

Una forma de hacer esto es lanzar una excepción. Hablaremos sobre las excepciones más adelante, pero de momento, si no sabes lo que son te bastará con saber que son errores que podemos "capturar" en un bloque try-catch para decidir cómo actuar en caso de que se produzcan.

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
    
	    function __construct($aTitle, $anAuthore) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	        $this->available = false;
	    }
    
	    public function lend() {
	        if (!$this->isAvailable()) {
	            throw new Exception ('El libro '.$this->title.' está prestado o en restauración');
	        }
	        $this->available = false;
	    }
    
	    public function getBack() {
	        $this->available = true;
	    }
    
	    public function isAvailable() {
	        return $this->available;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');
	try {
	    $aBook->lend();
	    echo $aBook->title.' acaba de ser prestado.';
	} catch(Exception $e) {
	    echo $e->getMessage();
	}
	?>

¿Qué está ocurriendo aquí? Una vez instanciado el libro lo intentamos prestar. Como en nuestro sistema el libro no está disponible nada más ser ingresado (ver el método __construct), el método lend arrojará una excepción porque el libro no está disponible. La excepción será capturada por el bloque catch, que muestra el mensaje de error de la misma.

### El método getBack

El método getBack se limita a poner en true la propiedad $available.

### El método isAvailable

El método isAvailable devuelve el estado de disponibilidad del libro, para lo cual simplemente devuelve el valor de la propiedad `$available`. Podríamos argumentar que no es muy diferente de getAvailable, pero no es así. Para empezar, el propio nombre del método es mucho más explícito:

* getAvailable significa "dame el valor de la propiedad $available", y ya lo interpretaré yo,
* isAvailable significa "¿está este libro disponible?". No necesito interpreatar nada.

Otra parte de la cuestión es que el método isAvailable puede hacer más comprobaciones si fuese necesario, sin tener que cambiar su interfaz pública. Supongamos que la clase Book mantiene una propiedad ($refurbish) que nos indica si el libro está siendo restaurado:

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
	    private $refurb;
    
	    function __construct($aTitle, $anAuthore) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	        $this->available = false;
	        $this->refurb = false;
	    }
    
	    public function lend() {
	        if (!$this->isAvailable()) {
	            throw new Exception ('El libro '.$this->title.' está prestado o en restauración');
	        }
	        $this->available = false;
	    }
    
	    public function getBack() {
	        $this->available = true;
	    }
    
	    private function isAvailable() {
	        return $this->available && !$this->refurb;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');
	try {
	    $aBook->lend();
	    echo $aBook->title.' acaba de ser prestado.';
	} catch(Exception $e) {
	    echo $e->getMessage();
	}
	?>

Si observas el código anterior verás que no hemos tenido que tocar nada en lo que respecta a usar el objeto $aBook, todos los cambios han sido dentro de la definición de la clase y, específicamente, dentro del método isAvailable que ahora toma en consideración el estado de $refurbish para responder.

Pero el código "cliente", el código que usa la clase Book no ha tenido que cambiarse para nada, es exactamente el mismo que antes. Ese es un ejemplo de cómo utilizar la encapsulación para nuestro beneficio, ya que la clase Book puede evolucionar sin necesidad de tocar el código que ya la utiliza.

Te habrás fijado que `isAvailable()` está definido como método privado. De momento, al escribir este código pensamos que ningún agente externo va a preguntar directamente si el libro está disponible, sencillamente solicitará el préstamo y se le responderá a eso. Sin embargo, en otro contexto podría ser necesario hacer público ese método. De nuevo, la visibilidad de los métodos es una cuestión de necesidades en el contexto de tu aplicación específica.

En muchos casos es una buena práctica comenzar con métodos privados y hacerlos visibles sólo si se descubre que es realmente necesario.

Añadamos un par de métodos para manejar la posibilidad de enviar un libro a restaurar.

	<?php 

	class Book {
	    private $title;
	    private $author;
	    private $available;
	    private $refurb;
    
	    function __construct($aTitle, $anAuthore) {
	        $this->title = $aTitle;
	        $this->author = $anAuthor;
	        $this->available = false;
	        $this->refurb = false;
	    }
    
	    public function lend() {
	        if (!$this->isAvailable()) {
	            throw new Exception ('El libro '.$this->title.' está prestado o en restauración');
	        }
	        $this->available = false;
	    }
    
	    public function refurb() {
	        if (!$this->isAvailable()){
	             throw new Exception ('El libro '.$this->title.' está prestado o en restauración');
	        }
	        $this->refurb = true;
	    }
    
	    public function getBack() {
	        $this->available = true;
	    }
    
	    public function getBackAfterRefurb() {
	        $this->refurb = false;
	    }
    
	    public function isAvailable() {
	        return $this->available && !$this->refurb;
	    }
	}

	$aBook = new Book('El Quijote', 'Miguel de Cervantes');
	$aBook->refurb();
	try {
	    $aBook->lend();
	    echo $aBook->title.' acaba de ser prestado.';
	} catch(Exception $e) {
	    echo $e->getMessage();
	}
	?>

Como puedes comprobar, de nuevo hemos podido hacer evolucionar la clase sin modificar el código cliente existente, salvo en el hecho de haber añadido un paso para utilizar la nueva funcionalidad. Todo gracias a diseñar los métodos de nuestra clase a partir de comportamientos útiles para nuestro sistema.
