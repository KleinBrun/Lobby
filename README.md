# Hoteleria Lobby
Bienvenidos al proyecto.

Para garantizar un funcionamiento correcto, es necesario seguir los siguientes pasos:

1. Instalar XAMPP: Descarguen e instalen XAMPP, una plataforma que incluye Apache y MySQL.

2. Iniciar el panel de control: Una vez instalado XAMPP, abran el panel de control y asegúrense de activar Apache y MySQL.

3. Crear la base de datos: En MySQL, creen una base de datos llamada "lobbypms"(para ello entren a la ruta http://localhost/phpmyadmin y le dan en nueva y ponen el nombre).

4. Preparar el entorno: Dentro de la ruta htdocs (C:\xampp\htdocs) de XAMPP, creen una carpeta con cualquier nombre. Esta carpeta será el destino de los archivos del proyecto.

5. Descargar el repositorio: Descarguen el repositorio y colóquenlo dentro de la carpeta que crearon en el htdocs. El repositorio contiene una carpeta llamada lobby y dentro  dos carpetas: "front" y "back". ( git clone https://github.com/KleinBrun/Lobby.git )

6. Iniciar el servidor de backend: En la carpeta "back" renombren el archivo ".env.example" a ".env" , abran una consola y ejecuten los siguientes comandos: "composer install" y esperamos que se insatalen los paquetes , luego "php artisan migrate" y luego "php artisan serve". Mantengan la consola abierta con el último comando en ejecución.

7. Iniciar el servidor de frontend: En la carpeta "front", abran una nueva consola sin cerrar la anterior y ejecuten el comando "npm install" y esperamos que se instalen los paquetes, luego  "npm run serve". Mantengan esta consola abierta para que el servidor quede activo.

Con estos pasos, ambos servidores estarán funcionando. Por lo general, podrán acceder al proyecto a través de la siguiente ruta: http://localhost:8080/. Esta dirección se mostrará en la ventana de comandos. Solo tienen que abrir esa ruta en su navegador y ¡listo!
