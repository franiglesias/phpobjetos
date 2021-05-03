## El patrón Fachada (Facade)

El patrón Fachada es un patrón de tipo estructural que persigue encapsular operaciones complejas o repetitivas en una interfaz simplificada. El patrón Fachada ayuda a lograr DRY y KISS.

Supongamos que queremos o tenemos que utilizar una librería de código, ya sea procedural u orientada a objetos, la cual resulta compleja de manejar o que requiere muchas instrucciones repetitivas y/o preparación de datos y otros objetos cada vez que queremos realizar alguna tarea. La solución sería construir una clase "fachada" con métodos que utilicen esa librería. Nuestra aplicación se relaciona con la Fachada y no tiene que saber nada acerca de la librería.

En cierto modo, el patrón Fachada es la base de otros patrones como el Adaptador o el Decorador pues, al igual que éstos, envuelve o encapsula un código para que sea accesible de un modo diferente y más conveniente para la aplicación.

Las diferencias serían: 

* La Fachada busca simplificar una interfaz compleja para hacerla manejable.
* El Adaptador busca convertir la interfaz "externa" en una interfaz esperada por las clases cliente, que suele estar definida explícitamente, y persigue habilitar el polimorfismo.
* El decorador añade funcionalidad a un objeto en tiempo de ejecución envolviéndolo, pero no busca cambiar la interfaz.

Un caso típico en PHP es el acceso a la base de datos, para lo que es habitual crear una clase que simplifique los pasos de configuración, conexión, petición de datos, etc. Otro ejemplo puede ser el uso de la librería gráfica GD.

Los elementos del patrón sería:

* Fachada: la clase que encapsula. Utiliza el Sistema encapsulado para realizar su tarea.
* Sistema encapsulado: una librería, una clase compleja, una colección de clases relacionadas, etc. No sabe nada de la fachada.
* Usuarios: el código usuario de la Fachada y que quiere usar el sistema encapsulado. Conoce la interfaz de Fachada, y no sabe nada del sistema encapsulado.

Las Fachadas nos ayudan en varios aspectos:

* Reducen la complejidad del código al delegar en un objeto especializado llamadas complejas al sistema encapsulado.
* Mejoran la mantenibilidad al centralizar en un solo lugar código que puede ser utilzado muchas veces.
* Reduce la complejidad de las dependencias, al confinarlas a una clase, lo que, a su vez, permite cambiarlas fácilmente reescribiendo la fachada (que es la base del patrón Adaptador). Aunque la fachada está fuertemente acoplada al sistema encapsulado, pero de ese modo desacopla el resto de la aplicación.
* Nos permite crear puntos de entrada entre capas o subsistemas.
