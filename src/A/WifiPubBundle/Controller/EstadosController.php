<?php

namespace A\WifiPubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use A\WifiPubBundle\Model\Model;
 use A\WifiPubBundle\Config\Config;

class EstadosController extends Controller
{
    public function RecepcionAction()
    {

	$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
	                         Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

	        $params = array('titulo' => "Recepción articulos",
	        	 'Proveedores' => $m->lista("Proveedores"),
	        	 'Articulos' => $m->lista("Articulos"),
	        	 'mensaje' => "",
		           );

 		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$serials = explode('<br />', nl2br($_POST['numsSerie']));


			$unixtime=strtotime($_POST['fecha']);
			for($j=0;$j<count($serials);$j++){
		  		if ($m->altaRouter($unixtime,$_POST['Proveedor'],$_POST['Articulo'],$_POST['Doc'],$serials[$j])) {
		               $params['mensaje'] = 'Añadidos correctamente';
		              
		           } else {
		               $params['mensaje'] = 'No se ha podido guardar. Revisa el formulario';
		               break;
		           }
				}
		}
    	else
    	{
			
		}

		return
	          $this->render('AWifiPubBundle:Estados:recepcion.html.twig',
	          $params);
  }

	    public function CambioEstadoAction()
    {

    		 $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
	                         Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
       $params = array('titulo' => "Cambio Estados",
       		 'Estados' => $m->lista("Estados"),
        	 'Articulos' => $m->lista("Articulos"),
        	  'mensaje' => "",
	           );


       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$serials = explode('<br />', nl2br($_POST['numsSerie']));


			$unixtime=strtotime($_POST['fecha']);
			for($j=0;$j<count($serials);$j++){
		  		if ($m->cambiarEstado($unixtime,$_POST['Articulo'],$_POST['Estado'],$serials[$j])) {
		               $params['mensaje'] = 'Cambiados correctamente';
		              
		           } else {
		               $params['mensaje'] = 'No se ha podido guardar. Revisa el formulario';
		               break;
		           }
				}
		}
    	else
    	{
			
		}
		return
          $this->render('AWifiPubBundle:Estados:cambio.html.twig',
          $params);
		
	}
//public function EntragaInstalador($articulo,$instaldor,$fecha,$doc,$numserie)
		    public function EntregaInstaladorAction()
    {

    	 $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
	                         Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
       $params = array('titulo' => "Entrega Instalador",
       	 		'Instaladores' => $m->lista("Instaladores"),
        	 	'Articulos' => $m->lista("Articulos"),
    	 	    'mensaje' => "",
	           );


          if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$serials = explode('<br />', nl2br($_POST['numsSerie']));


			$unixtime=strtotime($_POST['fecha']);
			for($j=0;$j<count($serials);$j++){
		  		if ($m->entragaInstalador($_POST['Articulo'],$_POST['Instalador'],$unixtime,$_POST['Doc'],$serials[$j])) {
		               $params['mensaje'] = 'Entregados correctamente';
		           } else {
		               $params['mensaje'] = 'No se ha podido guardar. Revisa el formulario';
		               break;
		           }
				}
		}
    	else
    	{
			
		}
		return
          $this->render('AWifiPubBundle:Estados:entrega.html.twig',
          $params);
		
	}


		    public function InstalacionAction()
    {
    	 $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
	                         Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
       $params = array('titulo' => "Instalación",
       		'Clientes' => $m->lista("Clientes"),
			'Instalaciones' => $m->lista("Instalaciones"),
   		    'mensaje' => "",
	           );



         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$serials = explode('<br />', nl2br($_POST['numsSerie']));


			$unixtime=strtotime($_POST['fecha']);
			for($j=0;$j<count($serials);$j++){
		  		if ($m->instalacion($_POST['Cliente'],$_POST['Instalacion'],$unixtime,$serials[$j])) {
		               $params['mensaje'] = 'Instalados correctamente';
		           } else {
		               $params['mensaje'] = 'No se ha podido guardar. Revisa el formulario';
		               break;
		           }
				}
		}
    	else
    	{
			
		}
		return
          $this->render('AWifiPubBundle:Estados:instalacion.html.twig',
          $params);
		
	}


	  public function obtenerAction($serial)
    {
        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                     Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $elemento = $m->obtenerHistorico($serial);
        $columnas = array(array('column_name'=>"NumSerie"),array('column_name'=>"Estado"),array('column_name'=>"FechaEstado"),array('column_name'=>"Articulo"),array('column_name'=>"Proveedor"),array('column_name'=>"FechaProveedor"),array('column_name'=>"ProveedorDoc"),array('column_name'=>"Instalador"),array('column_name'=>"FechaInstalador"),array('column_name'=>"InstaladorDoc"),array('column_name'=>"Cliente"),array('column_name'=>"Instalación"),array('column_name'=>"FechaInstalación"));
        if(!$elemento)
        {
          throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
        }

        $params = array('tabla'=>"Histórico",'columnas'=>$columnas,'elemento'=> $elemento,);

            return
              $this->render('AWifiPubBundle:Admin:detalle.html.twig',
              $params);
          
    }

	public function listaAction($id_estado,$pag)
    {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{
			   return $this->redirect($this->generateUrl('wifipub_lstado', array(
        		'id_estado'  => $_POST['id_estado'],
        		'pag' => 1,
    			)));

		  				
		}
		else
		{
	  		$m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
	                     Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

		
			$titulo = "Listado NumSerie";
	 		
			$estado=  $m->elemento("Estados",$id_estado);
			if ($id_estado!=0) {
				$titulo="Listado NumSerie en estado:" . $estado['Descripcion'];
			}
			        
	        $elementos = $m->obtenerSerials($id_estado,$pag);
	      	$count= $m->countSerials($id_estado);
	  		$estados = $m->lista('Estados');
	  		$params = array('titulo'=>$titulo,'elementos'=> $elementos,'Estados'=>$estados,'id_estado'=>$id_estado,'pag'=>$pag,);
	      	if ($count>$pag*50) {
				$params['siguiente']=true;
	      	}

	     	return $this->render('AWifiPubBundle:Estados:lista.html.twig',
	              $params);
		}
}

        public function listaInicialAction()
    {
    	   return $this->forward('AWifiPubBundle:Estados:lista', array(
        'id_estado'  => 0,
        'pag' => 1,
    ));
    }
}