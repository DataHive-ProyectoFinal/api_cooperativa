<?php
// Validamos que venga el usuario desde el controlador
if (!isset($usuario)) {
    echo "<p>Error: No se encontró información del usuario.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link rel="stylesheet" href="../Frontend/Home Socios/VerPerfil.css">
    <title>Home Socios</title>
</head>
<body>

    <nav class="fixed top-0 z-50 w-full bg-blue-900 border-b border-gray-200 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-blue-500 rounded-lg sm:hidden hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-blue-400 dark:hover:bg-green-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="#" class="flex ms-2 md:me-24">
                  <img src="../Frontend/multimedia/logo-cooperativa.svg" class="h-11 me-3" alt="Vista Linda Logo" />

                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">Vista Linda - Socios</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-md shadow-sm dark:bg-green-900 dark:divide-gray-600" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            
                        </div>
                        <ul class="py-1" role="none">
                        
                            <li>
                            <a href="#" class="block px-4 py-2 text-sm text-red-300  dark:hover:text-red-200" role="menuitem">Cerrar sesion</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </nav>

        <!-- Sidebar -->
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

        <!-- Contenido principal -->
        <main class="sm:ml-64 pt-20 bg-gray-50 min-h-screen flex flex-col">
  <!-- Perfil -->
  <section class="bg-white rounded-lg shadow-sm p-8 mx-6 text-center">
    <img class="w-32 h-32 mx-auto rounded-full " 
         src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" 
         alt="user photo">
<h1 class="mt-4 text-gray-800 text-3xl font-bold">
  <?= htmlspecialchars($usuario['nombre_completo']); ?>
</h1>
<p class="text-gray-600 text-lg">
  <?= htmlspecialchars($usuario['gmail']); ?>
</p>
    <div class="mt-6">
      <a href="editarPerfil.php" 
         class="px-6 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-600">
        Editar Perfil
      </a>
    </div>
  </section>

            <!-- Tarjetas inferiores -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 m-6">
    <div class="bg-blue-800 p-6 rounded-lg shadow-md text-gray-100">
      <h2 class="text-lg font-semibold mb-2">Info 1</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore et velit autem illo amet quod illum...</p>
    </div>
    <div class="bg-blue-800 p-6 rounded-lg shadow-md text-gray-100">
      <h2 class="text-lg font-semibold mb-2">Info 2</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore et velit autem illo amet quod illum...</p>
    </div>
    <div class="bg-blue-800 p-6 rounded-lg shadow-md text-gray-100">
      <h2 class="text-lg font-semibold mb-2">Info 3</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore et velit autem illo amet quod illum...</p>
    </div>
  </section>
    
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
  </main>
</body>
</html>
