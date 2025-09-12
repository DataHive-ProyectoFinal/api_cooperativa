<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../Frontend/Home Socios/EditarPerfil.css">
  
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
<nav class="fixed top-0 left-0 right-0 z-50 bg-blue-900 border-b border-gray-200 p-4 flex justify-between items-center">
    <div class="flex items-center">
        <a href="#" class="flex items-center">
            <img src="../Frontend/multimedia/logo-cooperativa.svg" class="h-11 me-3" alt="Vista Linda Logo">
            <span class="text-xl font-semibold text-white">Vista Linda - Socios</span>
        </a>
    </div>
    <div class="flex items-center">
        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300">
            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
        </button>
    </div>
</nav>

<div class="flex flex-1 pt-20">
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-green-700 border-r border-gray-200 sm:translate-x-0  dark:border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-green-700 ">
                <ul class="space-y-2 font-medium">

                    <li>
                        <a href="/PruebaProyecto2/api_usuarios/VerPerfil.php" class="flex items-center p-2 text-gray-200 rounded-lg  hover:bg-green-600 hover:bg-green-600 group">
                        <svg class="shrink-0 w-6 h-6  transition duration-75 text-gray-200 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Ver perfil</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-200 rounded-lg  hover:bg-green-600 hover:bg-green-600 group">
                        <svg class="shrink-0 w-6 h-6  transition duration-75 text-gray-200 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Pagos</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-200 rounded-lg  hover:bg-green-600 hover:bg-green-600 group">
                        <svg class="shrink-0 w-6 h-6  transition duration-75 text-gray-200 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Horas trabajadas</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-200 rounded-lg  hover:bg-green-600 hover:bg-green-600 group">
                        <svg class="shrink-0 w-6 h-6  transition duration-75 text-gray-200 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Avances de la obra</span>
                        </a>
                    </li>
                    
                    
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2  rounded-lg text-white hover:bg-green-600 group">
                        <svg class="shrink-0 w-5 h-5  transition duration-75 text-gray-200 group-hover:text-gray-900 " aria-hidden="true"  fill="currentColor" viewBox="0 0 20 20">
                            <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Reportes</span>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800  rounded-full bg-green-900 text-green-300">7</span>
                        </a>
                    </li>
                    
                
                    
                </ul>
            </div>
            </aside>

 <main class="flex-1 ml-0 sm:ml-64 p-6">
        <div class="bg-white p-8 rounded-2xl shadow-xl max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Perfil</h2>

            <form action="guardarPerfil.php" method="POST" class="space-y-4">

    <div class="stacked">
        <label>Nombre completo:</label>
        <input type="text" name="nombre_completo" value="<?= htmlspecialchars($usuario['nombre_completo']) ?>" 
               class="w-full px-3 py-2 border rounded-lg bg-gray-100" required>
    </div>

    <div class="stacked">
        <label>Email:</label>
        <input type="email" name="gmail" value="<?= htmlspecialchars($usuario['gmail']) ?>" 
               class="w-full px-3 py-2 border rounded-lg bg-gray-100" required>
    </div>

<div class="stacked">
        <label>Genero:</label>
        <select id="generoSelect" class="w-full px-3 py-2 border rounded-lg bg-gray-100" required>
                            <option value="">Seleccionar</option>
                            <option value="Femenino" <?= $usuario['genero'] == 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                            <option value="Masculino" <?= $usuario['genero'] == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                            <option value="Otro" <?= $usuario['genero'] == 'Otro' ? 'selected' : '' ?>>Otro</option>
                            <option value="Prefiero no decirlo" <?= $usuario['genero'] == 'Prefiero no decirlo' ? 'selected' : '' ?>>Prefiero no decirlo</option>
                            </select>
    <input type="hidden" name="genero" id="generoInput" value="<?= htmlspecialchars($usuario['genero']) ?>">
    
    <script>
    document.getElementById('generoSelect').addEventListener('change', function() {
        document.getElementById('generoInput').value = this.value;
    });
</script>

    </div>
<div class="stacked">
        <label>Teléfono celular:</label>
        <input type="text" name="telefono_celular" value="<?= htmlspecialchars($usuario['telefono_celular']) ?>" 
               class="w-full px-3 py-2 border rounded-lg bg-gray-100">
    </div>

    <div class="stacked">
        <label>Teléfono fijo:</label>
        <input type="text" name="telefono_fijo" value="<?= htmlspecialchars($usuario['telefono_fijo']) ?>" 
               class="w-full px-3 py-2 border rounded-lg bg-gray-100">
    </div>

    <div class="stacked">
        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>" 
               class="w-full px-3 py-2 border rounded-lg bg-gray-100" required>
    </div>

    <div class="stacked">
        <label>Integrantes de familia:</label>
        <input type="number" name="cantidad_familia" value="<?= htmlspecialchars($usuario['cantidad_familia']) ?>" 
               class="w-full px-3 py-2 border rounded-lg bg-gray-100">
    </div>

<div class="stacked">
        <label>Integrantes con descapacidad (si/no):</label>
        <input type="text" name="discapacidad_cargo" value="<?= htmlspecialchars($usuario['discapacidad_cargo']) ?>" 
               class="w-full px-3 py-2 border rounded-lg bg-gray-100">
    </div>

   <div class="stacked">
    <label>Ocupación:</label>
    <select id="ocupacionSelect" class="w-full px-3 py-2 border rounded-lg bg-gray-100" required>
        <option value="">Seleccionar</option>
        <option value="Trabajador formal" <?= $usuario['ocupacion'] == 'Trabajador formal' ? 'selected' : '' ?>>Trabajador formal</option>
        <option value="Informal" <?= $usuario['ocupacion'] == 'Informal' ? 'selected' : '' ?>>Informal</option>
        <option value="Desempleado" <?= $usuario['ocupacion'] == 'Desempleado' ? 'selected' : '' ?>>Desempleado</option>
        <option value="Estudiante" <?= $usuario['ocupacion'] == 'Estudiante' ? 'selected' : '' ?>>Estudiante</option>
        <option value="Otro" <?= $usuario['ocupacion'] == 'Otro' ? 'selected' : '' ?>>Otro</option>
    </select>
    <input type="hidden" name="ocupacion" id="ocupacionInput" value="<?= htmlspecialchars($usuario['ocupacion']) ?>">
</div>

<script>
    document.getElementById('ocupacionSelect').addEventListener('change', function() {
        document.getElementById('ocupacionInput').value = this.value;
    });
</script>

<div class="stacked">
    <label>Ingreso mensual:</label>
    <select id="ingresoSelect" class="w-full px-3 py-2 border rounded-lg bg-gray-100" required>
        <option value="">Seleccionar</option>
        <option value="Menos de $20.000" <?= $usuario['ingreso'] == 'Menos de $20.000' ? 'selected' : '' ?>>Menos de $20.000</option>
        <option value="$20.001 - $50.000" <?= $usuario['ingreso'] == '$20.001 - $50.000' ? 'selected' : '' ?>>$20.001 - $50.000</option>
        <option value="$50.001 - $80.000" <?= $usuario['ingreso'] == '$50.001 - $80.000' ? 'selected' : '' ?>>$50.001 - $80.000</option>
        <option value="Más de $80.000" <?= $usuario['ingreso'] == 'Más de $80.000' ? 'selected' : '' ?>>Más de $80.000</option>
    </select>

    <input type="hidden" name="ingreso" id="ingresoInput" value="<?= htmlspecialchars($usuario['ingreso']) ?>">
</div>

<script>
    document.getElementById('ingresoSelect').addEventListener('change', function() {
        document.getElementById('ingresoInput').value = this.value;
    });
</script>

<div class="flex justify-between mt-6 flex-col sm:flex-row gap-4">
        <button type="submit" class="btn-guardar">Guardar cambios</button>
        <a href="VerPerfil.php" class="btn-cancelar">Cancelar</a>
    </div>

</form>

        </div>
    </main>
</div>
  <footer class="bg-blue-900 text-gray-300 mt-auto">
    <div class="w-full mx-auto max-w-screen-xl p-4 flex flex-col md:flex-row items-center justify-between">
      <span class="text-sm text-gray-400">
        © 2023 <a href="#" class="hover:underline">DataHive</a>. Todos los derechos reservados.
      </span>
      <ul class="flex flex-wrap gap-4 mt-3 md:mt-0 text-sm">
        <li><a href="#" class="hover:underline">Política</a></li>
        <li><a href="#" class="hover:underline">Términos</a></li>
        <li><a href="#" class="hover:underline">Soporte</a></li>
      </ul>
    </div>
  </footer>
</body>
</html>
