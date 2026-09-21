# Informe Técnico de Consultoría: Arquitectura Web

## 1. Cliente vs. Servidor

- **Cliente:** HTML, CSS y JavaScript, descargados y ejecutados en el navegador del usuario (motores como V8 en Chrome o SpiderMonkey en Firefox). Es código visible: cualquiera puede abrirlo desde las herramientas de desarrollador del navegador y modificarlo antes de que se ejecute.
- **Servidor:** PHP, ejecutado en vuestra máquina remota. El cliente nunca ve ese código, solo recibe el HTML ya generado. Aquí es donde debe vivir la lógica de negocio, el acceso a la base de datos y la autenticación.
- **Regla de oro: nunca confiar en el cliente.** Si el precio o el stock de un producto se validaran solo en JavaScript, cualquiera podría manipular esa validación (editando el código en el navegador o enviando la petición directamente al servidor) y comprar a un precio incorrecto o sin stock real. Toda validación crítica de negocio debe repetirse siempre en el servidor.

## 2. Web Estática vs. Web Dinámica

- **Estática:** el servidor entrega siempre el mismo HTML a todos los visitantes, sin consultar ninguna base de datos. Rápida y sencilla, pero rígida.
- **Dinámica:** el servidor genera el HTML en cada petición, según el usuario y los datos almacenados. Es la única opción viable para una tienda online: catálogo que cambia, carrito por cliente, stock actualizado en tiempo real.
- A medio plazo, muchas plataformas evolucionan hacia arquitecturas híbridas: una interfaz ligera en el cliente que consume una API que devuelve datos en JSON en lugar de HTML completo. No es un requisito inicial, pero conviene tenerlo en mente si en el futuro se añade una app móvil sobre la misma lógica de negocio.

## 3. Infraestructura: servidores y mecanismos de ejecución

- **Servidor web (Apache / Nginx):** recibe las peticiones HTTP, localiza el recurso solicitado y lo devuelve. Gestiona conexiones, SSL/TLS y caché.
- **De CGI a PHP-FPM:** CGI, el estándar original, creaba un proceso nuevo del sistema operativo por cada petición — simple, pero muy costoso en rendimiento. PHP-FPM mantiene un pool de procesos PHP ya arrancados y listos, evitando ese coste en cada petición. La diferencia de rendimiento bajo carga es de varios órdenes de magnitud, y además permite aislar distintos sitios en pools separados por seguridad.
- **Laravel** se apoya sobre PHP-FPM y asume buena parte de lo que en otros lenguajes correspondería a un servidor de aplicaciones aparte (como Tomcat en el mundo Java): gestión del ciclo de vida de la aplicación y de la seguridad, integradas en el propio framework.

## 4. PHP y Laravel 12

Antes de decidir el stack, valoramos las alternativas más habituales para desarrollo web dinámico: **Node.js**, **Python con Django** y **Ruby on Rails**, junto con PHP. Todas son opciones sólidas, pero para este proyecto recomendamos **PHP con Laravel 12** por:

- **Patrón MVC:** separa datos (Modelo, con Eloquent ORM), presentación (Vista, plantillas Blade) y control de peticiones (Controlador). Código más mantenible y más fácil de escalar a medida que la tienda crezca.
- **Seguridad por defecto:** protección nativa contra XSS, inyección SQL y CSRF, sin necesidad de configurarla manualmente. Crítico para una tienda que maneja datos de clientes y pagos.
- **Estructura de directorios simplificada:** Laravel 12 reduce la configuración inicial y facilita un desarrollo ágil.
- PHP mueve alrededor del 80% de la web, y Laravel es el framework PHP más usado según las encuestas de la comunidad. Ecosistema maduro, documentación abundante y disponibilidad de desarrolladores para el mantenimiento futuro de la plataforma.