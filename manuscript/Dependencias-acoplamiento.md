# Dependencias y acoplamiento

En programación decimos que se establece una **dependencia** cuando un módulo de software utiliza otro para realizar su trabajo. Si hablamos de clases, decimos que una clase (cliente) tiene un dependencia de otra (servicio) cuando cliente usa servicio para llevar a cabo sus propias responsabilidades. La dependencia se manifiesta porque la clase Cliente no puede funcionar sin la clase Servicio.

Las dependencias de software no son malas en sí mismas (tal y como se habla de ellas en algunos artículos parecería que sí). El problema de las dependencias es de grado. Es decir, hay dependencias muy fuertes y dependencias ligeras. La clave es cómo las gestionamos para que sean lo más ligeras posibles.

Al grado de dependencia entre dos unidades de software la llamamos **acoplamiento**. Decimos que hay un alto acoplamiento (thigh coupling) cuando tenemos que reescribir la clase Cliente si quisiéramos cambiar la clase Servicio por otra. Por el contrario, decimos que hay un bajo acoplamiento (loose coupling) cuando podemos cambiar la clase Servico por otra, sin tener que tocar a Cliente.

¿Cómo podemos hacer eso? Pues utilizando dos herramientas:

* El patrón de inyección de dependencias
* La D en SOLID: el principio de inversión de dependencias.

## Dependencias ocultas

Comencemos con la peor situación posible: la clase Cliente utiliza a la clase Servicio sin que nadie lo pueda saber. Veamos un ejemplo:

<<(code/dependencies-sample-1.php)

Para saber que Cliente utiliza servicio tendríamos que examinar su código fuente porque desde su interfaz pública no podemos ver nada.

En este caso el acoplamiento es máximo y en el momento en que tuviésemos que tocar Servicio por algún motivo, la funcionalidad de Cliente podría romperse. Por ejemplo, supón que Servicio es una clase de un paquete o biblioteca y los autores deciden actualizarla y cambian la interfaz de los métodos que usa cliente. Por mucho que en PHP tengas acceso al código te puedes imaginar la pesadilla de mantenimiento y los riesgos que supone. De hecho, tendrías que quedarte en una versión fija de Servicio y olvidarte de las actualizaciones.

Para lidiar con este problema tienes una solucón fácil y que es aplicar el patrón de inyección de dependencia:

<<(code/dependencies-sample-2.php)

Así de simple. Se trata de cargar la dependencia a través del constructor (o de un Setter). Ahora la dependencia es visible. Todavía hay un alto acoplamiento, pero ya empezamos a tener más libertad pues sabemos cómo se relacionan ambas clases.

## Inversión de dependencias

El principio de Inversión de Dependencias nos dice que:

* Los módulos de alto nivel no deben depender de módulos de bajo nivel. Ambos deben depender de abstracciones.
* Las abstracciones no deben depender de detalles, son los detalles los que deben depender de abstracciones.

En resumen: cualquier dependencia debe ser sobre abastracciones, no sobre implementraciones concretas.

En nuestro ejemplo, la dependencia es ahora explícita, lo que es bueno, pero Cliente depende de una implementación concreta de Servicio, lo que es malo.

Para invertir la dependencia debemos hacer lo siguiente:

Cliente no debe esperar una instancia concreta de Servicio, sino que debe esperar una clase que cumpla ciertas condiciones, o lo que es lo mismo, que respete un contrato. Y, como hemos visto, un contrato en programación es una interfaz. Y una interfaz es lo más abstracto de lo que podemos disponer en software.

Servicio, por su parte, debe respetar la interfaz para poder ser usada por Cliente, o sea, también debe depender de esa abstracción.

Así que necesitamos crear una interfaz