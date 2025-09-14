Como el usuario utiliza la función de Editar Perfil:


Registrar a un usuario llenando el formulario.
El administrador acepta la solicitud.
El sistema le asigna una contraseña al socio.
En la base de datos (cooperativa), ir a la tabla (solicitudes_ingreso) y verificar que el usuario ya esté aceptado con todos sus datos correspondientes.
El socio inicia sesion ingresando su cedula y contraseña.
Si reconoce su CI lo envia a verPerfil.php, ahi va a aparecer su nombre de usuario, gmail y una side bar para poder registrar sus horas, ver avance de obra, etc. 
En su perfil va a haber un botón que dice “Editar Perfil", lo presiona y lo envía  a editarPerfil.php, ahi aparecen sus datos (menos la CI ya que no se puede modificar) en formato de formulario.
Si el usuario desea modificar algún dato, como por ej su ingreso mensual lo cambia y apreta el botón que dice “Guardar cambios”, si no quiero ningún cambio y por error modifico algo aprieta el botón de “Cancelar”.
Cualquier decisión que tome lo vuelve a enviar a su perfil (verPerfil.php).
Para verificar que los cambios se han hecho correctamente, actualizar la base de datos y fijarse en la tabla de solicitudes_ingreso.



Cómo funciona el código que permite al usuario tener su perfil y poder modificar sus datos:


-En configuracion.php guardas los datos de acceso a la bdd.
-Incluye configuracion.php para obtener las variables.
-Crea el objeto $conexion.
-UsuarioController.php recibe la conexión abierta desde fuera ($conexion). La guarda en una propiedad para que todos los métodos del controlador puedan ejecutar consultas SQL.
-Usuario.php usa $this->conexion para preparar y ejecutar las consultas. Devuelve los resultados al controlador.
-Archivos de lógica (verPerfil.php, editarPerfil.php, guardarPerfil.php)
-Incluye la conexión.
-Crea el controlador y le pasa la conexión.
-Llama a la función que carga o guarda los datos.

El usuario entra a editarPerfil.php 
El archivo incluye conexion.php → abre la conexión a MySQL.
  
Se crea UsuarioController y se llama a editarPerfil().
 
El controlador usa el modelo (Usuario.php) para hacer un SELECT y obtener los datos.


 Se devuelven los datos a la vista, que los muestra en los inputs.
 
El usuario edita y envía el formulario a guardarPerfil.php.


 guardarPerfil.php vuelve a incluir conexion.php  (misma lógica de conexión.)
 
 El controlador llama al modelo para ejecutar el UPDATE con los nuevos datos.


 La base de datos guarda los cambios y se redirige o muestra un mensaje.



