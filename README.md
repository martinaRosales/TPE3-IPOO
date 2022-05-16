# TPE3-IPOO
Martina Milagros Rosales
FAI - 2752
Tecnicatura Universitaria en Desarrollo Web
Introducción a la Programación Orientada a Objetos

TP 3 ENTREGABLE
Apertura: miércoles, 11 de mayo de 2022, 00:00
Cierre: lunes, 16 de mayo de 2022, 23:59

La empresa de transporte desea gestionar la información correspondiente a los Viajes que pueden ser: Terrestres o Aéreos,   guardar su importe e indicar si el viaje es de ida y vuelta. De los viajes aéreos se conoce el número del vuelo, la categoría del asiento (primera clase o no), nombre de la aerolínea, y la cantidad de escalas del vuelo en caso de tenerlas. De los viajes terrestres se conoce la comodidad del asiento, si es semicama o cama.

La empresa ahora necesita implementar la venta de un pasaje, para ello debe realizar la función venderPasaje(pasajero) que registra la venta de un viaje al pasajero que es recibido por parámetro. La venta se realiza solo si hayPasajesDisponible. Si el viaje es terrestre y el asiento es cama, se incrementa el importe un 25%. Si el viaje es aéreo y el asiento es primera clase sin escalas, se incrementa un 40%, si el viaje además de ser un asiento de primera clase, el vuelo tiene escalas se incrementa el importe del viaje un 60%. Tanto para viajes terrestres o aéreos, si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%. El método retorna el importe del pasaje si se pudo realizar la venta.

Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y falso caso contrario.
