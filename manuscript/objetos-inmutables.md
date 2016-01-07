# Objetos inmutables

Los objetos inmutables son objetos que se instancian con unos valores que no cambian a lo largo de su ciclo de uso.

## DTO: Data Transfer Objects

[Definición de DTO de Martin Fowler](http://martinfowler.com/eaaCatalog/dataTransferObject.html "P of EAA: Data Transfer Object")

[DTO Pattern y una herramienta para la generación de DTO](http://neverstopbuilding.com/data-transfer-object "")

Se trata de objetos simples que se utilizan para mover datos entre procesos o clases. Podrías considerarlos como el equivalente de una interfaz pero para datos. Suponen un contrato entre las clases acerca de la forma en que comparten información.

Los DTO no suelen tener comportamiento, aparte del necesario para inicialización y para serialización. En cualquier caso no lleva lógica de negocio.

En su versión más simple un DTO es un objeto con propiedades públicas y un constructor para instanciarlo y asignar los valores. Esto no es muy diferente de lo que podríamos construir con un array asociativo y es frecuente encontrar [opiniones a favor de los arrays](http://stackoverflow.com/questions/2056931/value-objects-vs-associative-arrays-in-php "Value objects vs associative arrays in PHP - Stack Overflow") basadas en su sencillez y velocidad. Sin embargo, la gran ventaja de los DTO viene de la mano del *Type Hinting*, lo cual nos permite usar los DTO como auténticos contratos sobre la transferencia de datos entre clases o partes de una aplicación, sumado a otros muchos beneficios derivados del uso de objetos.

Por ejemplo, el siguiente bug puede pasar fácilmente desapercibido, asumiendo que el array tiene una clave 'name':

	$name = $data['nmae'];

Mientras que el código equivalente con un DTO simple nunca funcionaría:

	$name = data->nmae;

Sin embargo, el hecho de un objeto tenga propiedades que son accesibles públicamente tiene el riesgo de que podrían modificarse, de modo que una forma más explícita sería hacer privadas las propiedades del DTO y añadirle getters para recuperar cada una de ellas. Es un poco más engorroso pero de esta forma nos aseguramos de que los objetos son realmente inmutables y los valores se mantienen sea cual sea el proceso por el que tengan que pasar.

### Cuando usar DTO

#### Patrón objeto-parámetro

Cuando un método o función necesita muchos argumentos es posible simplificar su signatura agrupando esos argumentos en uno o más objetos simples.

Por ejemplo:

<?php	?>

#### Devolución de datos múltiples de un método

PHP, como otros lenguajes, sólo permite un único valor de vuelta de un método. Si necesitamos devolver más, podemos componer un DTO.

## Value Objects

El concepto viene del DDD se refiere a objetos que representan valores importantes para el dominio, su igualdad viene dada por la igualdad de sus propiedades.

Los Value Objects tienen comportamientos.

El ejemplo clásico de Value Object es el dinero (Money), que usamos en precios, salarios, etc. Habitualmente modelamos los valores del dinero con números de coma flotante, pero el valor no es suficiente. El dinero es el valor y la moneda que se esté utilizando: no es lo mismo 10 dólares que 10 euros. Puede argumentarse que en muchas aplicaciones no es necesario tener en cuenta la moneda, pero si algún día en el futuro eso cambiase, el impacto en el código podría ser enorme.

Dado que en OOP pretendemos encapsular lo que cambia junto, tiene sentido crear una clase de objetos para representar dinero que tenga dos propiedades: valor y monedo.

	<?php

	class Money {
		private $amout;
		private $currency;
	
		public function __construct($amount, $currency) {
			$this->amount = $amount;
			$this->currency = $currency;
		}
	
		public function getAmount() {
			return $this->amount;
		}
	}
	?>

Aunque un objeto sea inmutable, puede tener métodos que se basen en sus propiedades para generar nuevos valores. Dicho de otra forma, deben devolver instancias de nuevos objetos con los nuevos valores, en lugar de reasignar las propiedades del objeto valor.

<<(code/money.php)

