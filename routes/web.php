<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\IsAdmin;
use App\Http\Controllers\WelcomePageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GuiaController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\RutaRastreoController;
use App\Http\Controllers\PagosPageController;
use App\Http\Controllers\CallBackAdminController;
use App\Http\Controllers\ConsultarAdminController;
use App\Http\Controllers\RutasController;
use App\Http\Controllers\WhatsAppNotificationController;
use App\Http\Controllers\GuiasFindController;
use App\Http\Controllers\GuiasFindMobileController;
use App\Http\Controllers\VentasAdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomePageController::class)->name('/');
Route::post('/notificaciones/whatsapp/callback', CallBackAdminController::class)->name('admin.notificaciones.callback');







// FIND GUIA
Route::get('/guia',GuiasFindController::class)->name('guia.find');
Route::get('/buscar-guia/{guia_codigo}', [GuiasFindMobileController::class, 'search']);
//si es administrador

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('is.admin')->group(function(){
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        // GESTIONAR USUARIOS
        Route::get('/admin-users', [UsersController::class, 'index'])->name('admin.users');
        Route::get('/admin-users/create', [UsersController::class, 'create'])->name('admin.users.create');
        Route::post('/admin-users/register', [UsersController::class, 'store'])->name('admin.users.register');
        Route::get('/admin-users/edit/{user_id}', [UsersController::class, 'edit'])->name('admin.users.edit');
        Route::patch('/admin-users/edit/{user_id}', [UsersController::class, 'update'])->name('admin.users.update');
        Route::delete('admin-users/destroy/{user_id}',  [UsersController::class, 'destroy'])->name('admin.users.delete');

            // GESTIONAR PRODUCTOS
            Route::get('/admin-productos', [ProductoController::class, 'index'])->name('admin.productos');
            Route::get('/admin-producto/create', [ProductoController::class, 'create'])->name('admin.producto.create');
            Route::post('/admin-producto/store',[ProductoController::class, 'store'])->name('admin.producto.store');
            Route::get('/admin-producto/edit/{producto_id}',[ProductoController::class, 'edit'])->name('admin.producto.edit');
            Route::patch('/admin-producto/update/{producto_id}', [ProductoController::class, 'update'])->name('admin.producto.update');
            Route::delete('admin-producto/destroy/{producto_id}',  [ProductoController::class, 'destroy'])->name('admin.producto.destroy');
             // GESTIONAR PROVEEDORES
             Route::get('/admin.proveedores', [ProveedorController::class, 'index'])->name('admin.proveedores');
             Route::get('/admin-proveedor/create', [ProveedorController::class, 'create'])->name('admin.proveedor.create');
             Route::post('/admin-proveedor/store',[ProveedorController::class, 'store'])->name('admin.proveedor.store');
             Route::get('/admin-proveedor/edit/{proveedor_id}',[ProveedorController::class, 'edit'])->name('admin.proveedor.edit');
             Route::patch('/admin-proveedor/update/{proveedor_id}', [ProveedorController::class, 'update'])->name('admin.proveedor.update');
             Route::delete('admin-proveedor/destroy/{proveedor_id}',  [ProveedorController::class, 'destroy'])->name('admin.proveedor.destroy');
        // GESTIONAR ALMACEN
        Route::get('/admin-almacenes', [AlmacenController::class, 'index'])->name('admin.almacenes');
        Route::get('/admin-almacen/create',[AlmacenController::class, 'create'])->name('admin.almacen.create');
        Route::post('/admin-almacen/store',[AlmacenController::class, 'store'])->name('admin.almacen.store');
        Route::get('/admin-almacen/edit/{almacen_id}',[AlmacenController::class, 'edit'])->name('admin.almacen.edit');
        Route::patch('/admin-almacen/update/{almacen_id}', [AlmacenController::class, 'update'])->name('admin.almacen.update');
        Route::delete('admin-almacen/destroy/{almacen_id}',  [AlmacenController::class, 'destroy'])->name('admin.almacen.destroy');


        //GESTIONAR SERVICIOS
        Route::get('/admin-servicios', [ServicioController::class, 'index'])->name('admin.servicios');
        Route::get('/admin-servicio/create',[ServicioController::class, 'create'])->name('admin.servicio.create');
        Route::post('/admin-servicio/store',[ServicioController::class, 'store'])->name('admin.servicio.store');
        Route::get('/admin-servicio/edit/{servicio_id}',[ServicioController::class, 'edit'])->name('admin.servicio.edit');
        Route::patch('/admin-servicio/update/{servicio_id}', [ServicioController::class, 'update'])->name('admin.servicio.update');
        Route::delete('admin-servicio/destroy/{servicio_id}',  [ServicioController::class, 'destroy'])->name('admin.servicio.destroy');

        //GESTIONAR PAQUETE
        Route::get('/admin-paquetes',[PaqueteController::class, 'index'])->name('admin.paquetes');
        Route::get('/admin-paquete/create',[PaqueteController::class, 'create'])->name('admin.paquete.create');
        Route::post('/admin-paquete/store',[PaqueteController::class, 'store'])->name('admin.paquete.store');
        Route::get('/admin-paquete/edit/{paquete_id}',[PaqueteController::class, 'edit'])->name('admin.paquete.edit');
        Route::patch('/admin-paquete/update/{paquete_id}', [PaqueteController::class, 'update'])->name('admin.paquete.update');
        Route::delete('admin-paquete/destroy/{paquete_id}',  [PaqueteController::class, 'destroy'])->name('admin.paquete.destroy');

         //GESTIONAR GUIA
         Route::get('/admin-guias',[GuiaController::class, 'index'])->name('admin.guias');
         Route::get('/admin-guia/create',[GuiaController::class, 'create'])->name('admin.guia.create');
         Route::post('/admin-guia/store',[GuiaController::class, 'store'])->name('admin.guia.store');
         Route::get('/admin-guia/edit/{guia_id}',[GuiaController::class, 'edit'])->name('admin.guia.edit');
         Route::get('/admin-guia/show/{guia_id}',[GuiaController::class, 'show'])->name('admin.guia.show');
         Route::patch('/admin-guia/update/{guia_id}', [GuiaController::class, 'update'])->name('admin.guia.update');
         Route::delete('admin-guia/destroy/{guia_id}',  [GuiaController::class, 'destroy'])->name('admin.guia.destroy');


         //GESTIONAR RUTA_RASTREO
         Route::get('/admin-rutasrastreos',[RutaRastreoController::class, 'index'])->name('admin.rutasrastreos');
         Route::get('/admin-rutarastreo/create',[RutaRastreoController::class, 'create'])->name('admin.rutarastreo.create');
         Route::post('/admin-rutarastreo/store',[RutaRastreoController::class, 'store'])->name('admin.rutarastreo.store');
         Route::get('/admin-rutarastreo/edit/{rutarastreo_id}',[RutaRastreoController::class, 'edit'])->name('admin.rutarastreo.edit');
         Route::patch('/admin-rutarastreo/update/{rutarastreo_id}', [RutaRastreoController::class, 'update'])->name('admin.rutarastreo.update');
         Route::delete('admin-rutarastreo/destroy/{rutarastreo_id}',  [RutaRastreoController::class, 'destroy'])->name('admin.rutarastreo.destroy');
         Route::post('/admin-rutarastreo/checkIn', [RutaRastreoController::class, 'checkIn'])->name('admin.rutarastreo.checkIn');


            //GESTIONAR RUTA
            Route::get('/admin-rutas',[RutasController::class, 'index'])->name('admin.rutas');
            Route::get('/admin-ruta/create',[RutasController::class, 'create'])->name('admin.ruta.create');
            Route::post('/admin-ruta/store',[RutasController::class, 'store'])->name('admin.ruta.store');
            Route::post('/admin-ruta-vertice/store',[RutasController::class, 'verticestore'])->name('admin.ruta.verticestore');
            Route::get('/admin-ruta-check-in/show',[RutasController::class, 'checkInShow'])->name('admin.ruta.checkIn.show');
            Route::post('/admin-ruta/checkIn',[RutasController::class, 'checkIn'])->name('admin.ruta.checkIn');

            Route::post('/admin-ruta-arco/store',[RutasController::class, 'arcostore'])->name('admin.ruta.arcostore');
            Route::get('/admin-ruta/show/{ruta_id}',[RutasController::class, 'show'])->name('admin.ruta.show');
            Route::get('/admin-ruta/edit/{ruta_id}',[RutasController::class, 'edit'])->name('admin.ruta.edit');
            Route::patch('/admin-ruta/update/{ruta_id}', [RutasController::class, 'update'])->name('admin.ruta.update');
            Route::delete('admin-ruta/destroy/{ruta_id}',  [RutasController::class, 'destroy'])->name('admin.ruta.destroy');

  //GESTIONAR VENTAS
  Route::get('/admin-ventas',[VentasAdminController::class, 'index'])->name('admin.ventas');
  Route::get('/admin-ventas/create',[VentasAdminController::class, 'create'])->name('admin.ventas.create');
  Route::post('/admin-ventas/store',[VentasAdminController::class, 'store'])->name('admin.ventas.store');
  Route::get('/admin-ventas/edit/{venta_id}',[VentasAdminController::class, 'edit'])->name('admin.ventas.edit');
  Route::patch('/admin-ventas/update/{venta_id}', [VentasAdminController::class, 'update'])->name('admin.ventas.update');
  Route::delete('admin-ventas/destroy/{venta_id}',  [VentasAdminController::class, 'destroy'])->name('admin.ventas.destroy');

         //GESTIONAR NOTIFICACIONES
         Route::get('/admin-notificaciones',[WhatsAppNotificationController::class, 'index'])->name('admin.notificaciones');
         Route::get('/admin-notificaciones-whatsapp/show',[WhatsAppNotificationController::class, 'show'])->name('admin.notificacion.show');
         Route::post('/admin-notificaciones-whatsapp/store',[WhatsAppNotificationController::class, 'instanciastore'])->name('admin.notificacion.store');
 //GESTIONAR REPORTES
 Route::get('/admin-reportes',[ReporteController::class, 'index'])->name('admin.reportes');
 Route::post('/reportes/paquetes-enviados-por-rango', [ReporteController::class, 'paquetesEnviadosPorRangoFechas']);
 Route::post('/reportes/monto-total-enviado-por-rango', [ReporteController::class, 'montoTotalEnviadoPorRangoFechas']);


         //CREAR QR
         Route::get('/proxy/get_qrcode', function () {
            $instanceId = request('instance_id');
            $token = request('access_token');
            $response = Http::get("https://whatsapp.desarrollamelo.com/api/get_qrcode", [
                'instance_id' => $instanceId,
                'access_token' => $token,
            ]);

            return $response->body();
        });
// CREAR INSTANCIA
        Route::get('/proxy/get_instance', function () {
            $token = request('access_token');
            $response = Http::get("https://whatsapp.desarrollamelo.com/api/create_instance", [
                'access_token' => $token,
            ]);

            return $response->body();
        });

        // WEBHOOK
        Route::get('/proxy/get_webhook', function () {
            $instanceId = request('instance_id');
            $token = request('access_token');
            $enable = request('enable');
            $webhook = request('webhook_url');
            $response = Http::get("https://whatsapp.desarrollamelo.com/api/set_webhook", [
                'instance_id' => $instanceId,
                'access_token' => $token,
                'enable' => $enable,
                'webhook_url' => $webhook,
            ]);

            return $response->body();
        });

         // SEND MESSAGE
         Route::post('/proxy/send_message', function () {
            $instanceId = request('instance_id');
            $token = request('access_token');
            $number = request('number');
            $message = request('message');
            $response = Http::post("https://whatsapp.desarrollamelo.com/api/send", [
                'instance_id' => $instanceId,
                'access_token' => $token,
                'number' => $number,
                'message' => $message,
            ]);

            return $response->body();
        });


              //GESTIONAR PAGOS
          Route::get('/admin-pagos',[PagosPageController::class, 'index'])->name('admin.pagos');
          Route::get('/admin-pagos/create',[PagosPageController::class, 'create'])->name('admin.pagos.create');
          Route::post('/admin-pagos/store',[PagosPageController::class, 'store'])->name('admin.pagos.store');
          Route::get('/admin-pagos/edit/{pago_id}',[PagosPageController::class, 'edit'])->name('admin.pagos.edit');
          Route::patch('/admin-pagos/update/{pago_id}', [PagosPageController::class, 'update'])->name('admin.pagos.update');
          Route::delete('admin-pagos/destroy/{pago_id}',  [PagosPageController::class, 'destroy'])->name('admin.pagos.destroy');

        });

 // PAGOS WEB
            Route::post('/pagos/generarCobro', [PagosPageController::class, 'generarCobro'])->name('admin.pagos.generarCobro');
            Route::post('/pagos/callback', CallBackAdminController::class)->name('admin.pagos.callback');
            Route::get('/pagos/consultar/{venta_id}', ConsultarAdminController::class)->name('admin.pagos.consultar');



    Route::middleware('is.student')->group(function(){
        Route::get('/only-student', function () {
            return 'solo el estudiante puede ver esto';
        });
    });
});


require __DIR__.'/auth.php';
