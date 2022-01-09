# chucknorris_api
Program using the chucknorris.io API for a technical interview. 

Para crear este programa, me he servido de Symfony y PHP 8.0 como herramientas. Pasaré muy por encima de la parte de front, uso Twig para renderizar las vistas y
comunicarme con JS donde uso jQuery para realizar las peticiones mediante AJAX al back mediante una promesa. El front es muy mejorable pero entiendo que lo que 
se valora aquí es el back.

El back está estructurado mediante una arquitectura hexagonal, siendo el punto de entrada los Controllers mediante las rutas definidas en routing.yaml, que recibirán
el request del front, estos se comunican con Buses (CQRS) usando Queries y Handlers para comunicarse con la capa de Aplicación, en la cual tenemos englobado bajo el módulo "Search" las acciones que pertenecen a este dominio. Explicar el funcionamiento específico de todas las acciones sería demasiado largo, así que haré un 
resumen de las partes mas genéricas de la aplicación.

Al entrar en una de las acciones (las cuales tienen las dependencias inyectadas en el constructor), normalmente usaremos el ApiRequest, que es nuestro punto de 
entrada a la API chucknorris.io (no he visto necesario utilizar aquí un patrón Repository ya que esta es la única API que vamos a atacar y realmente no es necesario
desacoplarnos de ella). Una vez dentro, usamos HttpClientInterface para alimentarnos de la API y devolver el resultado de esta. 

Una vez devuelto el resultado, queremos convertir la información de la API a una información relevante a nuestro dominio, entonces entra en juego SearchResultMapper
que utilizará un map para generar una colección de resultados con un searchId que nos servirá para identificar la búsqueda en el futuro (esto es fundamental para
paginar y envíar la búsqueda por mail, lo cual comentaré luego).

Para persistir la búsqueda en base de datos, nos servimos de un evento de dominio SearchWasCreated que pasa por un EventBus (configuración en messenger.yaml) y pasa
de forma síncrona a un listener SearchWasCreatedHandler. Este listener va a un caso de uso que se comunica con el repositorio mediante un patrón Repository y apunta
a Doctrine, donde guardaremos todos los resultados de una búsqueda con una id compuesta de searchId y resultId en batches. A posteriori podremos usar este repositorio
para sacar resultados paginados en base al searchId.

Finalmente, al devolver los datos al controlador como un Envelope, manejamos mediante ApiResponse el serializado para devolver la información al front. En el caso 
del Mailer, utilizamos el mailer de Symfony con extensiones de Twig para aplicarle una de las vistas. No he configurado un servidor smtp pero en el profiler se 
puede ver que los emails funcionan.

Para terminar, quiero comentar mi estrategia de testing, tengo una suite de tests unitarios cuyo propósito es comprobar la cobertura de código, "mockeando" las
dependencias reales que se testean a parte (ej. ApiRequestTest). Utilizo objetos Mother y Doubles para no acoplarme a la implementación real al testear.

Mis tests de integración usan un environment arranger para asegurar que ejecuto los tests en un entorno de test y en una base de datos que se vacía al terminar el 
testing, evitando poner carga en la base de datos de producción. Estos tests hacen llamadas reales a API y comprueba que los repositorios funcionen y devuelvan 
la información que esperamos. He evitado usar tests de aceptación por que eran demasiado complejos en forma y tiempo para el scope de esta aplicación.

Adjunto una carpeta con imágenes del código que muestran algunos de los componentes de esta aplicación
