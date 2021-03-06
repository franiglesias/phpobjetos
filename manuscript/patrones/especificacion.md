## El patrón especificación (Specification)

El patrón especificación encapsula las reglas de negocio para seleccionar objetos.

Al usar el patrón repositorio podemos encontrarnos el problema de tener que crear métodos para hacer selecciones específicas de objetos. Cada vez que necsitamos una nueva selección con nuevos criterios tendríamos que crear un método nuevo que aplique los correspondientes criterios. El patrón especificación soluciona ese problema encapsulando las condiciones en un objeto sencillo con un único método `isSatisfiedBy` al que se le pasa un objeto del dominio y que devuelve un valor boolean.

Esto nos indica si los objetos individuales satisfacen la especificación por lo que el repositorio tendría que obtener antes todos los objetos almacenados y examinarlos uno por uno hasta encontrar todos los que la cumplen. Por supuesto, en muchos sistemas esta tarea consume excesivos recursos por lo que debemos encontrar un método más económico. Por ejemplo, un sistema que sea capaz de cargar una selección manejable de objetos y que aplique luego la especificación en ellos, o bien, una traducción de la especificación al lenguaje del almacenamiento concreto.

En este último caso, puede ser interesante que la Especificación contenga un método que devuelva las reglas de negocio de una manera que pueda ser usada por el repositorio para hacer la consulta al medio de almacenamiento. Por ejemplo, si es un repositorio basado en SQL, podríamos tener un método `asSql()` que simplemente nos devuelva la petición tal como la necesitaríamos para realizar la consulta en la base de datos. Esto difumina un poco las fronteras entre capas, pero simplifica el código del Repositorio y elimina la necesidad de un intermediario que traduzca la especificación. Pero, al fin y a la postre, el Repositorio mismo es un espacio de frontera y, en la práctica, la Especificación sigue perteneciendo al dominio.

Otro uso de la Especificación podría ser la validación. En efecto, `isSatisfiedBy` es un método de validación, ya que comprueba que el objeto que se le pasa cumple con ciertas condiciones.

La primera ventaja es que el Repositorio no necesita conocer tanto de la Entidad o del Agregado que maneja, sino que esta tarea queda en manos de las diferentes especificaciones. 

Si necesitamos usar nuevos conjuntos de criterios no tendríamos más que crear una nueva Especificación y utilizarla.



http://culttt.com/2014/08/25/implementing-specification-pattern/

Es una manera de encapsular reglas de negocio para devolver un valor boolean.
Nos permite crear clases que tengan una sola responsabilidad y que se puedan combinar con otros objetos del mismo tipo (especificaciones) para gestionar requisitos complejos.

La Especificación tiene un método público isSatisfiedBy que devuelve un boolean.

Este patrón funciona bien para validar objetos, pero no tanto para seleccionarlos.

En este caso habría que usar DoubleDispatch crear un método satisfyingElementsFrom en la especficación que se corresponda con un método de selección en el repositorio. El repositorio podría utilizar una petición para obtener un conjunto de datos próximo y usar la especificacion para filtrarlos.

 http://stackoverflow.com/questions/33331007/implement-specification-pattern
 
 Especificaciones compuestas
 
 Nos permiten crear especificaciones complejas combinando otras más simples. Aquí hay una explicación clara:
 
 http://marcaube.ca/2015/05/specifications/
 
Especificaciones compuestas

