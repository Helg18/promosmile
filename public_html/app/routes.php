<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('login.login');
});

Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::resource('/users','UserController');
Route::get("users-roles",array("before" => "auth","as" => "usuariosRoles","uses" => "UsuariosController@rolUsuario"));
Route::post("users-assigned-role",array("before" => "auth","as" => "asignarRol", "uses" => "UsuariosController@asignarRol"));
Route::resource('/roles','RolesController');

Route::get('/permisos','PermisosController@index');
Route::get('/permisos/asignar','PermisosController@asignar');
Route::get('/permisos/desasignar','PermisosController@desasignar');

Route::get('/home', array('as' => 'home','uses' => 'BootController@getIndex'));


//************ Prospectos ***************************************************
Route::get("prospectos",						array("as" => "prospectos", 'uses' => 'ProspectosController@prospectos'));
Route::get("prospectos-form/",					array("as" => "prospectosForm", 'uses' => 'ProspectosController@prospectosForm'));
Route::post("prospectos-save",					array("as" => "prospectosSave", 'uses' => 'ProspectosController@prospectosSave'));
Route::get("prospectos-editar-form/{id?}",		array("as" => "prospectosEditarForm", 'uses' => 'ProspectosController@prospectosEditarForm'));
Route::post("prospectos-editar",				array("as" => "prospectosEditar", 'uses' => 'ProspectosController@prospectosEditar'));
Route::get("prospectos-mostrar-form/{id?}",		array("as" => "prospectosMostrarForm", 'uses' => 'ProspectosController@prospectosMostrarForm'));
Route::get("prospectos-delete/{id?}",			array("as" => "prospectosEliminar", 'uses' => 'ProspectosController@prospectosEliminar'));
Route::controller('prospectos', 'ProspectosController');
//************ End Prospectos  ***************************************************

//************ Clientes ***************************************************
Route::get("clientes",array("as" => "clientes", 'uses' => 'ClienteController@clientes'));
Route::get("clientes-form/",array("as" => "clientesForm", 'uses' => 'ClienteController@clientesForm'));

Route::get("clientes-historial/{id?}",array("as" => "clientesHistorial", 'uses' => 'ClienteController@clientesHistorial'));

Route::post("clientes-save",array("as" => "clientesSave", 'uses' => 'ClienteController@clientesSave'));
Route::post("clientes-save-new",array("as" => "clientesSaveNew", 'uses' => 'ClienteController@clientesSaveNew'));
Route::get("clientes-editar-form/{id?}",array("as" => "clientesEditarForm", 'uses' => 'ClienteController@clientesEditarForm'));
Route::post("clientes-editar",array("as" => "clientesEditar", 'uses' => 'ClienteController@clientesEditar'));
Route::get("clientes-mostrar-form/{id?}",array("as" => "clientesMostrarForm", 'uses' => 'ClienteController@clientesMostrarForm'));
Route::get("clientes-delete/{id?}",array("as" => "clientesEliminar", 'uses' => 'ClienteController@clientesEliminar'));
//************ End Clientes  ***************************************************

//************ Carta de presentación ***************************************************
Route::get("carta-presentacion",array("as" => "carta", 'uses' => 'CartaController@carta'));
Route::get("carta-editar-form",array("as" => "cartaEditar", 'uses' => 'CartaController@cartaEditarForm'));
Route::post("carta-save",array("as" => "cartaSave", 'uses' => 'CartaController@cartaSave'));
Route::post("carta-save-file",array("as" => "archivoSave", 'uses' => 'CartaController@archivoSave'));
Route::get("carta-editar-form/{id?}",array("as" => "cartaEditarForm", 'uses' => 'CartaController@cartaEditarForm'));
//************ End Carta de presentación ***************************************************


//************ Proveedores ***************************************************
Route::get("proveedores",array("as" => "proveedores", 'uses' => 'ProveedorController@proveedores'));
Route::get("proveedores-form/",array("as" => "proveedoresForm", 'uses' => 'ProveedorController@proveedoresForm'));
Route::post("proveedores-save",array("as" => "proveedoresSave", 'uses' => 'ProveedorController@proveedoresSave'));
Route::get("proveedores-editar-form/{id?}",array("as" => "proveedoresEditarForm", 'uses' => 'ProveedorController@proveedoresEditarForm'));
Route::post("proveedores-editar",array("as" => "proveedoresEditar", 'uses' => 'ProveedorController@proveedoresEditar'));
Route::get("proveedores-mostrar-form/{id?}",array("as" => "proveedoresMostrarForm", 'uses' => 'ProveedorController@proveedoresMostrarForm'));
Route::get("proveedores-delete/{id?}",array("as" => "proveedoresEliminar", 'uses' => 'ProveedorController@proveedoresEliminar'));
//************ End Proveedores  ***************************************************


//************ Vendedores ***************************************************
Route::get("vendedores",array("as" => "vendedores", 'uses' => 'VendedorController@vendedores'));
Route::get("vendedores-form/",array("as" => "vendedoresForm", 'uses' => 'VendedorController@vendedoresForm'));
Route::post("vendedores-save",array("as" => "vendedoresSave", 'uses' => 'VendedorController@vendedoresSave'));
Route::get("vendedores-editar-form/{id?}",array("as" => "vendedoresEditarForm", 'uses' => 'VendedorController@vendedoresEditarForm'));
Route::post("vendedores-editar",array("as" => "vendedoresEditar", 'uses' => 'VendedorController@vendedoresEditar'));
Route::get("vendedores-mostrar-form/{id?}",array("as" => "vendedoresMostrarForm", 'uses' => 'VendedorController@vendedoresMostrarForm'));
Route::get("vendedores-delete/{id?}",array("as" => "vendedoresEliminar", 'uses' => 'VendedorController@vendedoresEliminar'));
//************ End Vendedores  ***************************************************


//************ End Articulos  ***************************************************

 //************ Articulos  ***************************************************
    Route::get("articulos",                          array( 'as' => "see.productos",             'uses' =>'ArticulosController@articulos'));
    Route::post("articulos-load",                     array( 'as' => "articulosLoad",             'uses' =>'ArticulosController@articulosLoad'));
    Route::get('articulos/create',                    array( 'as' => 'create.productos',          'uses' =>'ArticulosController@getCreate'));
    Route::get('articulos/create2/{total_registros?}/{limit_inicio?}/{limit_fin?}/{posicion?}', array( 'as' => 'create2.productos',          'uses' =>'ArticulosController@getCreate2'));
    Route::post('articulos/post/create',              array( 'as' => 'post.create.productos',     'uses' =>'ArticulosController@postCreate'));
    Route::post('articulos/{productos}/edit',         array( 'as' => 'post.edit.productos',       'uses' =>'ArticulosController@postEdit'));
    Route::post('articulos/save-image',               array( 'as' => 'saveImage',       'uses' =>'ArticulosController@saveImage'));
    Route::get('articulos/image-edit/{id?}',          array( 'as' => 'editImage',       'uses' =>'ArticulosController@editImage'));
    Route::post('articulos/image-edit',               array( 'as' => 'editImagePos',       'uses' =>'ArticulosController@editImagePos'));
    Route::get('articulos/image-delete/{id?}',        array( 'as' => 'deleteImage',       'uses' =>'ArticulosController@deleteImage'));
    Route::get('articulos/empresas',                  array( 'as' => 'productos.empresas',     'uses' =>'ArticulosController@getEmp'));
    Route::post("pagina-articulos",array("as" => "pag.articulos", 'uses' => 'ArticulosController@articulos'));
    Route::get("articulos/BuscarArticulo/{id?}",                     array( 'as' => 'articulosbuscar', 'uses' => 'ArticulosController@articulo_especifico'));

    Route::get('articulos/ver',array('as'=>'verarticulo','uses'=>'ArticulosController@articulo_especifico'));


    Route::controller('articulos', 'ArticulosController');
    Route::post("descripcion",                        array( 'as' => "descripcion",             'uses' =>'ArticulosController@descripcion'));
    //************ Articulos Productos  ***************************************************

    //************ Cotización ***************************************************
Route::get("cotizacion",array("as" => "cotizacion", 'uses' => 'CotizacionController@cotizacion'));
Route::get("cotizacion-form/",                  array("as" => "cotizacionForm", 'uses' => 'CotizacionController@cotizacionForm'));
Route::post("cotizacion-save",                  array("as" => "cotizacionSave", 'uses' => 'CotizacionController@cotizacionSave'));
Route::post("cotizacion-enviar-email",     array("as" => "enviarEmailCliente", 'uses' => 'CotizacionController@enviarEmailCliente'));
Route::get("cotizacion-editar-form/{id?}",      array("as" => "cotizacionEditarForm", 'uses' => 'CotizacionController@cotizacionEditarForm'));
Route::post("cotizacion-editar",                array("as" => "cotizacionEditar", 'uses' => 'CotizacionController@cotizacionEditar'));
Route::get("cotizacion-mostrar-form/{id?}",     array("as" => "cotizacionMostrarForm", 'uses' => 'CotizacionController@cotizacionMostrarForm'));
Route::get("cotizacion-compras-form/{id?}",     array("as" => "cotizacionCompraForm", 'uses' => 'CotizacionController@cotizacionCompraForm'));
Route::get("cotizacion-pedir-form/{id?}",       array("as" => "cotizacionPedirForm", 'uses' => 'CotizacionController@cotizacionPedirForm'));
Route::post("cotizacion-pedir-save",            array("as" => "cotizacionPedirSave", 'uses' => 'CotizacionController@cotizacionPedirSave'));
Route::get("cotizacion-articulos",              array("as" => "cotizacion.articulos",'uses' =>'CotizacionController@getArticulos'));
Route::get("articulos-cotizacion/{id?}",        array("as" => "articulos.cotizacion",'uses' =>'CotizacionController@articulosCotizacion'));
Route::post("articulos-cotizacion-editar",      array("as" => "articulos.cotizacion.editar",'uses' =>'CotizacionController@articulosCotizacionEditar'));
Route::get("cotizacion-mostrar-pdf/{id?}",      array("as" => "cotizacionMostrarPdf", 'uses' => 'CotizacionController@cotizacionMostrarPdf'));
Route::get("cotizacion-delete/{id?}",           array("as" => "cotizacionEliminar", 'uses' => 'CotizacionController@cotizacionEliminar'));
Route::get("cuentas-cobrar",                     array("as" => "cuentasCobrar", 'uses' => 'CotizacionController@cuentasCobrar'));
Route::controller('cotizacion', 'CotizacionController');

Route::get("cuentas-cobrar",                     array("as" => "cuentasCobrar", 'uses' => 'CotizacionController@cuentasCobrar'));
Route::get("cuenta-cobrar-form/{id?}",           array("as" => "cuentaCobrarForm", 'uses' => 'CotizacionController@cuentaCobrarForm'));
Route::post("cuenta-cobrar",                     array("as" => "cuentaCobrar", 'uses' => 'CotizacionController@cuentaCobrar'));
//************ End Cotización  ***************************************************


//************ Compras ***************************************************
Route::get("compras",array("as" => "compras", 'uses' => 'ComprasController@compras'));
Route::get("compras-comprar/{id?}",array("as" => "comprasComrar", 'uses' => 'ComprasController@comprasComrar'));
Route::get("compras-form/",                  array("as" => "comprasForm", 'uses' => 'ComprasController@comprasForm'));
Route::post("compras-save",                  array("as" => "comprasSave", 'uses' => 'ComprasController@comprasSave'));
Route::post("compras-save-co",               array("as" => "comprasSaveCotizacion", 'uses' => 'ComprasController@comprasSaveCotizacion'));
Route::get("compras-editar-form/{id?}",      array("as" => "compraEditarForm", 'uses' => 'ComprasController@compraEditarForm'));
Route::post("compras-editar",                array("as" => "articulosCompraEditar", 'uses' => 'ComprasController@articulosCompraEditar'));
Route::get("compras-mostrar-form/{id?}",     array("as" => "comprasMostrarForm", 'uses' => 'ComprasController@comprasMostrarForm'));
Route::get("compras-mostrar-pdf/{id?}",      array("as" => "comprasMostrarPdf", 'uses' => 'ComprasController@comprasMostrarPdf'));
Route::get("compras-delete/{id?}",           array("as" => "comprasEliminar", 'uses' => 'ComprasController@comprasEliminar'));
Route::get("compras-editar-maquilar/{id?}", array("as" => "comprasMaquilarForm", 'uses' => 'ComprasController@comprasMaquilarForm'));
Route::post("cmaquilar-save",array("as" => "cmaquilarSave", 'uses' => 'ComprasController@cmaquilarSave'));
Route::post("compras-enviar-email",     array("as" => "enviarEmailProveedor", 'uses' => 'ComprasController@enviarEmailProveedor'));
Route::get("compras-recibir/{id?}",array("as" => "comprasRecibir", 'uses' => 'ComprasController@comprasRecibir'));
Route::get("compras-entregado/{id?}",array("as" => "comprasEntregado", 'uses' => 'ComprasController@comprasEntregado'));
Route::post("compras-asignar-almacen",array("as" => "asignarAlmacen", 'uses' => 'ComprasController@asignarAlmacen'));
Route::get("compras-mostrar-orden/{compra?}",array("as" => "mostrarOrden", 'uses' => 'ComprasController@MostrararOrden'));
Route::get("compras-mostrar-anticipo/{compra?}",array("as" => "mostrarAnticipo", 'uses' => 'ComprasController@MostrararAnticipo'));
Route::controller('compras', 'ComprasController');
Route::get("compras-logotipo/{id?}",array("as" => "logotipo","before" => "auth" ,'uses' => 'ComprasController@logotipos'));
Route::get("eliminar-logotipo/{id?}",array("as" => "eliminarLogtipo","before" => "auth" ,'uses' => 'ComprasController@eliminarLogtipo'));
Route::post("compras-agregar-logo/",array("as" => "addLogo","before" => "auth" , 'uses' => 'ComprasController@addLogo'));
Route::get("compras-descargar-logo/{p?}/{l?}",array("as" => "descargarLogo","before" => "auth" , "uses" => 'ComprasController@descargarLogo'));
Route::post("email-maquilero",array("as" => "emailMaquilero","before" => "auth","uses" => "ComprasController@enviarEmailMaquilero"));
Route::get("vista-previa/{id?}",array("as" => "vistaPrevia","before" => "auth","uses" => "ComprasController@vistaPrevia"));

Route::get("cuentas-pagar",                     array("as" => "cuentasPagar", 'uses' => 'ComprasController@cuentasPagar'));
Route::get("cuenta-pagar-form/{id?}",           array("as" => "cuentaPagarForm", 'uses' => 'ComprasController@cuentaPagarForm'));
Route::post("cuenta-pagar",                     array("as" => "cuentaPagar", 'uses' => 'ComprasController@cuentaPagar'));

Route::get("compras-entregas",array("as" => "entregas", "uses" => "ComprasController@entregas"));
Route::get("compras-entregas-fecha-form/{id?}",array("as" => "entregasFechaForm", "uses" => "ComprasController@entregasFechaForm"));
Route::post("compras-entregas-fecha",array("as" => "entregasFecha", "uses" => "ComprasController@entregasFecha"));


Route::get("cmaquilar-form/",array("as" => "cmaquilarForm", 'uses' => 'ComprasController@cmaquilarForm'));
//************ End Compras  ***************************************************

//************ Usuarios ***************************************************
Route::get("usuarios",array("as" => "usuarios", 'uses' => 'UsuariosController@usuarios'));
Route::get("usuarios-form/",array("as" => "usuariosForm", 'uses' => 'UsuariosController@usuariosForm'));
Route::post("usuarios-save",array("as" => "usuariosSave", 'uses' => 'UsuariosController@usuariosSave'));
Route::get("usuarios-editar-form/{id?}",array("as" => "usuariosEditarForm", 'uses' => 'UsuariosController@usuariosEditarForm'));
Route::post("usuarios-editar",array("as" => "usuariosEditar", 'uses' => 'Usuarios@usuariosEditar'));
Route::get("usuarios-mostrar-form/{id?}",array("as" => "usuariosMostrarForm", 'uses' => 'UsuariosController@usuariosMostrarForm'));
Route::get("usuarios-delete/{id?}",array("as" => "usuariosEliminar", 'uses' => 'UsuariosController@usuariosEliminar'));
//************ End Usuarios  ***************************************************


//************************ Almacenes *******************************************
Route::get("store-new",array("as" => "almacenCrearForm", "uses" => "AlmacenController@almacenCrearForm"));
Route::post("store-save",array("as" => "almacenCrear", "uses" => "AlmacenController@almacenCrear"));
Route::get("store-list",array("as" => "almacenLista", "uses" => "AlmacenController@almacenLista"));
Route::get("store-edit/{id?}",array("as" => "almacenEditarForm", "uses" => "AlmacenController@almacenEditarForm"));
Route::post("store-edit",array("as" => "almacenEditar", "uses" => "AlmacenController@almacenEditar"));
Route::get("store-delete/{id?}",array("as" => "almacenEliminar", "uses" => "AlmacenController@almacenEliminar"));
Route::get("store-view/{id?}",array("as" => "almacenVer", "uses" => "AlmacenController@almacenVer"));
Route::post("store-save-ajax",array("as" => "almacenCrearAjax", "uses" => "AlmacenController@almacenCrearAjax"));
//************************ end almacenes ***************************************

//************ Proveedores ***************************************************
Route::get("productost",array("as" => "productost", 'uses' => 'ProductoTController@productost'));
Route::get("productost-form/",array("as" => "productostForm", 'uses' => 'ProductoTController@productostForm'));
Route::post("productost-save",array("as" => "productostSave", 'uses' => 'ProductoTController@productostSave'));
Route::get("productost-editar-form/{id?}",array("as" => "productostEditarForm", 'uses' => 'ProductoTController@productostEditarForm'));
Route::post("productost-editar",array("as" => "productostEditar", 'uses' => 'ProductoTController@productostEditar'));
Route::get("productost-mostrar-form/{id?}",array("as" => "productostMostrarForm", 'uses' => 'ProductoTController@productostMostrarForm'));
Route::get("productost-delete/{id?}",array("as" => "productostEliminar", 'uses' => 'ProductoTController@productostEliminar'));
//************ End Proveedores  ***************************************************


//************************ Imagenes ********************************************
Route::get("images-load",array("as" => "imagenes", "uses" => "ImagenesController@imagenes"));
Route::get("images-list",array("as" => "imagenesLista", "uses" => "ImagenesController@imagenesLista"));
//************************ end Imagenes ****************************************

//************************ Color ************************************************
Route::get("color",array("as" => "color", "uses" => "ColorController@color"));
Route::post("color-save",array("as" => "colorSave", "uses" => "ColorController@colorSave"));
Route::get("color-edit-form/{id?}",array("as" => "colorEditForm", "uses" => "ColorController@colorEditForm"));
Route::post("color-edit",array("as" => "colorEdit", "uses" => "ColorController@colorEdit"));
Route::get("color-delete/{id?}",array("as" => "colorDelete", "uses" => "ColorController@colorDelete"));
Route::post("color-save-ajax",array("as" => "colorSaveAjax", "uses" => "ColorController@colorSaveAjax"));
//************************ end color ********************************************


//Route::get("email/{u?}",array("as" => "emailS","uses" => "CotizacionController@email"));
Route::get("pdf",array("as" => "pdf","uses" => "CotizacionController@guardarPdf"));
Route::post("formatear",array("as" => "formatear",function(){
    $num = Input::get("num");
    $num = number_format($num);
    return Response::json(array(
            "num" => $num,
            "campo" => Input::get("campo")
        ));
}));

//************************ Maquileros ******************************************
Route::get('maquileros-delete/{id}', ['as' => 'maquileros.delete', 'uses' => 'MaquilerosController@delete']);
Route::resource('maquileros', 'MaquilerosController');
//************************ end Maquileros **************************************

Route::get("permiso",function(){
    $crear_usuarios = new Permission();
    $crear_usuarios->name = "cuentas_cobrar";
    $crear_usuarios->display_name = "cuentas_cobrar";
    $crear_usuarios->save();

    $crear_usuarios = new Permission();
    $crear_usuarios->name = "cuentas_pagar";
    $crear_usuarios->display_name = "cuentas_pagar";
    $crear_usuarios->save();

    $crear_usuarios = new Permission();
    $crear_usuarios->name = "programacion_entregas";
    $crear_usuarios->display_name = "programacion_entregas";
    $crear_usuarios->save();
    
    $crear_usuarios = new Permission();
    $crear_usuarios->name = "catalogos";
    $crear_usuarios->display_name = "catalogos";
    $crear_usuarios->save();//creamos un nuevo permiso
});

