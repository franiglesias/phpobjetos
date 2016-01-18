## El patrón especificación (Specification)

Encapsula las reglas de negocio para seleccionar objetos.



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