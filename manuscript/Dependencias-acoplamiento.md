# Dependencias y acoplamiento

En programación decimos que se establece una **dependencia** cuando un módulo de software utiliza otro para realizar su trabajo. Si hablamos de clases, decimos que una clase (cliente) tiene un dependencia de otra (servicio) cuando cliente usa servicio para llevar a cabo sus propias responsabilidades. La dependencia se manifiesta porque la clase Cliente no puede funcionar sin la clase Servicio.

Las dependencias de software no son malas en sí mismas (tal y como se habla de ellas en algunos artículos parecería que sí). El problema de las dependencias es de grado. Es decir, hay dependencias muy fuertes y dependencias ligeras. La clave es cómo las gestionamos para que sean lo más flojas posibles.

De hecho, la existencia de dependencias es un buen indicio ya que podría indicar que estamos respetando el principio de Responsabilidad Única haciendo que unas clases deleguen en otras las tareas que no les corresponden.

Al grado de dependencia entre dos unidades de software la llamamos **acoplamiento**. Decimos que hay un alto acoplamiento (thigh coupling) cuando tenemos que reescribir la clase Cliente si quisiéramos cambiar la clase Servicio por otra. Esto es una violación del principio Abierto/Cerrado. Por el contrario, decimos que hay un bajo acoplamiento (loose coupling) cuando podemos cambiar la clase Servico por otra, sin tener que tocar a Cliente.

¿Cómo podemos hacer eso? Pues utilizando tres herramientas:

* El patrón de Inyección de dependencias
* La D en SOLID: el principio de inversión de dependencias.
* El patrón Adaptador

## Dependencias ocultas

Comencemos con la peor situación posible: la clase Cliente utiliza a la clase Servicio sin que nadie lo pueda saber. Veamos un ejemplo:

<<(code/dependencies-sample-1.php)

Para saber que Cliente utiliza servicio tendríamos que examinar su código fuente porque desde su interfaz pública no podemos ver nada.

Aquí se produce la violación del principio SOLID Abierto/Cerrado. Al estar así construída, la clase cliente está abierta a la modificación y para cambiar su comportamiento tenemos que reescribirla.

En este caso el acoplamiento es máximo y en el momento en que tuviésemos que tocar Servicio por algún motivo, la funcionalidad de Cliente podría romperse. Por ejemplo, supón que Servicio es una clase de un paquete o biblioteca y los autores deciden actualizarla y cambian la interfaz de los métodos que usa cliente. Por mucho que en PHP tengas acceso al código te puedes imaginar la pesadilla de mantenimiento y los riesgos que supone. De hecho, tendrías que quedarte en una versión fija de Servicio y olvidarte de las actualizaciones.

Para lidiar con este problema tienes una solución fácil y que es aplicar el patrón de inyección de dependencia:

<<(code/dependencies-sample-2.php)

Así de simple. Se trata de cargar la dependencia a través del constructor (o de un Setter). Ahora la dependencia es visible. Todavía hay un alto acoplamiento, pero ya empezamos a tener más libertad pues sabemos cómo se relacionan ambas clases.

## Inversión de dependencias

La inversión de dependencias es el camino que debemos seguir para reducir al máximo el acomplamiento entre dos clases o módulos. El principio de Inversión de Dependencias nos dice que:

* Los módulos de alto nivel no deben depender de módulos de bajo nivel. Ambos deben depender de abstracciones.
* Las abstracciones no deben depender de detalles, son los detalles los que deben depender de abstracciones.

En resumen: cualquier dependencia debe ocurrir sobre abastracciones, no sobre implementraciones concretas.

En nuestro ejemplo, la dependencia es ahora explícita, lo que es bueno, pero Cliente sigue dependiendo de una implementación concreta de Servicio, lo que es malo.

Para invertir la dependencia debemos hacer lo siguiente:

Cliente no debe esperar una instancia concreta de Servicio, sino que debe esperar una clase que cumpla ciertas condiciones, o lo que es lo mismo, que respete un contrato. Y, como hemos visto, un contrato en programación es una interfaz. Y una interfaz es lo más abstracto de lo que podemos disponer en software.

Servicio, por su parte, debe respetar la interfaz para poder ser usada por Cliente, o sea, también debe depender de esa abstracción.

Así que necesitamos crear una interfaz y hacer que Cliente espere cualquier clase que la implemente. ¿Cómo puedo definir la interfaz? Pues a partir de las necesidades o intereses de Cliente, Servicio tendrá que adaptarse.

<<(code/dependencies-sample-3.php)

El código mostrado no funcionará todavía: Service no implementa ServiceInterface por lo que Cliente no lo aceptará.

¿Por qué he cambiado el modo en que Cliente utiliza Servicio? Es decir, ¿por qué he cambiado el método que Cliente llama? Pues simplemente para ilustrar la necesidad de que la interfaz se escriba según las necesidades del cliente y también para mostrar cómo podemos hacer para Servicio cumpla la interfaz sin tener que tocar su código.

En el listado 3, Client depende de ServiceInterface, lo que significa que espera una clase que implementa un método `doTheThing()`. Sin embargo, Service no tiene ese método. Para resolverlo debemos o bien modificar la clase Service para implementar ServiceInterface o bien aplicar un patrón Adaptador, para utilizar la clase Service respetando ServiceInterface.

Un adaptador es una clase que implementa una interfaz usando otra clase, así que añadimos el adaptador a nuestro código:

<<(code/dependencies-sample-4.php)

La llamada se ha complicado un poco, pero los beneficios son enormes ya que hemos reducido el acoplamiento al mínimo posible:

A partir de ahora, las clases `Client` y `Service` pueden cambiar independientemente una de la otra con la condición de que la interfaz no cambie (y las interfaces están pensadas para ser estables en el tiempo salvo motivos muy justificados). Si fuese necesario tendríamos que modificar `ServiceAdapter` en el caso de que `Service` cambiase su interfaz.

En este ejemplo, imaginamos que Service ha sufrido un cambio que rompe la compatibilidad hacia atrás:

<<(code/dependencies-sample-5.php)

Es más, podríamos sustituir `Service` por cualquier otra clase que o bien cumpla la interfaz `ServiceInterface` por sí misma o bien lo haga a través de un Adaptador. De este modo, podemos modificar el comportamiento de `Client` sin tocar su código, respetando así el principio Abierto/Cerrado.

Ahora añadimos una nueva clase que pueda sustituir a Service:

<<(code/dependencies-sample-6.php)

### Sobre los Adaptadores

Entre los Adaptadores y las clases adaptadas existe una dependecia o acoplamiento muy estrechos. Es obvio que no podemos desacoplarlos. Este acoplamiento no es problema ya que para los efectos de nuestro Cliente, el Adaptador *es* el Servicio y no le preocupa cómo está implementado con tal de que respete la interfaz. Además, el Adaptador es una clase con un código trivial, se limita a *traducir* los mensajes entre el Cliente y el Servicio.

Esto nos podría llevar a pensar en ocultar la dependencia y hacela implícita, como forma de ahorrar un poco de código al instanciar el adaptador, pero no es muy buena idea. Todas las dependencias deberían ser explícitas.

## Cuando la Inyección de dependencias se complica

Como se puede ver en los ejemplos anteriores, el desacoplamiento aumenta un poco la complejidad en el momento de instanciar la clase Cliente. Si ésta tiene varias dependencias, las cuales pueden utilizar Adaptadores, la inyección de dependencias se hace tediosa y prolija aunque no especialmente complicada. Sin embargo, eso quiere decir que hay que repetir un buen pedazo de código en diversas partes de una aplicación para conseguir instanciar un cierto objeto.

La solución para eso es utilizar algunos de los diferentes patrones de construcción de objetos, como factorías, constructores, pools o prototipos que automaticen esa instanciación.

Otra solución es lo que se llama un Contenedor de Inyección de Dependencias (DIC o Dependency Injection Container) que es, ni más ni menos, una clase encargada de proporcionarnos objetos de una clase completamente construídos. Se puede decir que los DIC hacen uso de diversos patrones de construcción de objetos para que nosotros podamos registrar la forma en que se deben instanciar.

## No siempre hay que desacoplar

El acoplamiento debemos considerarlo en el contexto del comportamiento de la clase Cliente. Ésta utiliza un comportamiento de la clase Servidor para poder llevar a cabo su propio comportamiento.

Esto no se cumple en ciertos casos. Por ejemplo, cuando hablamos de Value Objects, éstos no contribyuen al comportamiento de la clase usuaria del mismo modo. Los Value Objects se utilizan como si fuesen tipos primitivos del lenguaje y su comportamiento está destinado proporcionar servicios a la clase protegiendo sus propias invariantes. Los Value Objects son inmutables y además no tienen dependencias externas o, si las tienen, son de otros ValueObjects. Por lo tanto son objetos que pueden ser instanciados sin más con new o con un constructor estático con estático si lo hemos diseñado así.

Así que podemos distinguir entre objetos "newables" y objetos "inyectables". [Miško Hevery lo explica muy bien](http://misko.hevery.com/2008/09/30/to-new-or-not-to-new/ "To &#8220;new&#8221; or not to &#8220;new&#8221;&#8230;"). En resumen:

Los objetos newables son aquellos que necesitan algún parámetro variable en el momento de su creación. De hecho, necesitaremos un objeto nuevo cada vez. Imagina una clase Email que represente una dirección de email o incluo un mensaje (ojo, no lo envía, sólo lo representa, pero también se encarga de validarlo y asegurarse de que está bien construido). Necesitamos un objeto distinto por cada dirección de email o mensaje. Veamos un ejemplo:

<<(code/dependencies-newable.php)

Los objetos newables no se pueden inyectar porque el contenedor de inyección de dependencias no puede saber qué parámetros necesita cada instancia concreta. Podríamos tener una factoría a la que pasarle el parámetro y que nos devuelva el objeto construido, pero ¿para qué? `new`, en este caso, es una factoría tan buena como cualquiera. Y en realidad es la mejor.

Los newables no necesitan de interfaces explícitas porque no tienes que tener un abanico de opciones. En cualquier caso un objeto newable podría extender otro por herencia y, en ese caso, la clase base sería "la interfaz" si respetamos el principio de sustitución de Liskov, de modo que ambas clases sean intercambiables.

Los objetos inyectables, por su parte, son objetos que se pueden construir mediante un DIC porque no necseita parámetros que cambien en cada instanciación. Normalmente tienen interfaces porque han de ser sutituibles, es decir, queremos que las clases usuarias tengan un bajo acoplamiento con ellos.

Los inyectables y los newables no se deben mezclar. Es decir, un inyectable no puede construirse con algún newable, y tampoco un newable puede construirse pasándole un injectable. Eso no quiere decir que unos no puedan usar otros, pero han de pasarse como parámetros en métodos.


