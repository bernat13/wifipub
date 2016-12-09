<?php

namespace A\WifiPubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use A\WifiPubBundle\Model\Model;
 use A\WifiPubBundle\Config\Config;

class AdminController extends Controller
{
    public function indexAction($tabla)
    {
        if (  $tabla =="NumSerie" || $tabla =="Proveedores" || $tabla=="Clientes" ||$tabla=="Instaladores" ||$tabla=="Articulos" ||$tabla=="Instalaciones"||$tabla=="Estados") {
    		
    	
    	     $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
	                         Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

	         $params = array('titulo' => $tabla,
	         'elementos' => $m->lista($tabla),
	         );
    			if ($tabla=="Proveedores" ||$tabla=="Clientes" ||$tabla=="Instaladores"  ) 
    			{
    				return
    		          $this->render('AWifiPubBundle:Admin:tabla.html.twig',
    		          $params);
    			}
    			else if  ($tabla =="NumSerie")
          {
            
             return     $this->render('AWifiPubBundle:Admin:tablaNSerie.html.twig',
                  $params);

          }
          else
    			{
    				return
    		          $this->render('AWifiPubBundle:Admin:tablachica.html.twig',
    		          $params);
    			}

		}
		else
		{
			$fecha=  date('d-m-Y');
    	 	$params = array('fecha' =>$fecha,);
        	return $this->render('AWifiPubBundle:Default:index.html.twig',$params);
		}

         
   }

    public function obtenerAction($tabla,$id)
    {
        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                     Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $elemento = $m->elemento($tabla,$id);
        $columnas = $m->columnas($tabla);
        if(!$elemento)
        {
          throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
        }

        $params = array('tabla'=>$tabla,'columnas'=>$columnas,'elemento'=> $elemento,);

            return
              $this->render('AWifiPubBundle:Admin:detalle.html.twig',
              $params);
          
    }


 public function setInstalacionAction($id)
    {
     $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
        Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
      $elemento = $m->elemento("Instalaciones",$id);
     
  
      $params = array(
         
          'id'=>$id,
          'Descripcion' => $elemento['Descripcion'],
          'Direccion' => $elemento['Direccion'],
          'ContactoNombre' => $elemento['ContactoNombre'],
          'PosiciónGPS' => $elemento['PosiciónGPS'],
          'ContactoNombre' => $elemento['ContactoNombre'],
          'Email' => $elemento['Email'],
          'Telf' => $elemento['Telf'],
          'TipoInstalacion' => $elemento['TipoInstalacion'],
          'TipoAccesoInternet' => $elemento['TipoAccesoInternet'],
          'DownMbps' => $elemento['DownMbps'],
          'UpMbps' => $elemento['UpMbps'],
         );
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           // comprobar campos formulario
           if ($m->modificarInstalacion($id,$_POST['Descripcion'],$_POST['Direccion'],$_POST['ContactoNombre'],$_POST['PosiciónGPS'],$_POST['ContactoNombre'],$_POST['Email'],$_POST['Telf'],$_POST['TipoInstalacion'],$_POST['TipoAccesoInternet'],$_POST['DownMbps'],$_POST['UpMbps'])) {
                $params['mensaje'] = 'Modificado correctamente';
                $params[ 'Descripcion'] = $_POST['Descripcion'];
                $params[ 'Direccion'] = $_POST['Direccion'];
                $params[ 'ContactoNombre'] = $_POST['ContactoNombre'];
                $params[ 'PosiciónGPS'] = $_POST['PosiciónGPS'];
                $params[ 'ContactoNombre'] = $_POST['ContactoNombre'];
                $params[ 'Email'] = $_POST['Email'];
                $params[ 'Telf'] = $_POST['Telf'];
                $params[ 'TipoInstalacion'] = $_POST['TipoInstalacion'];
                $params[ 'TipoAccesoInternet'] = $_POST['TipoAccesoInternet'];
                 $params[ 'DownMbps'] = $_POST['DownMbps'];
                  $params[ 'UpMbps'] = $_POST['UpMbps'];
           } else {
               $params = array(
               
                'id'=>$id,
                'Descripcion' => $elemento['Descripcion'],
                'Direccion' => $elemento['Direccion'],
                'ContactoNombre' => $elemento['ContactoNombre'],
                'PosiciónGPS' => $elemento['PosiciónGPS'],
                'ContactoNombre' => $elemento['ContactoNombre'],
                'Email' => $elemento['Email'],
                'Telf' => $elemento['Telf'],
                'DownMbps' => $elemento['DownMbps'],
                'TipoAccesoInternet' => $elemento['TipoAccesoInternet'],
          'UpMbps' => $elemento['UpMbps'],
          'TipoInstalacion' => $elemento['TipoInstalacion'],
               );
               $params['mensaje'] = 'No se ha podido modificar. Revisa el formulario';
           }
         }
         return
          $this->render('AWifiPubBundle:Admin:formModificarInstalacion.html.twig',
          $params);
    }
    public function modificarAction($tabla,$id)
    {
     $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
        Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
      $elemento = $m->elemento($tabla,$id);
   
     
      $params = array(
          'tabla'=>$tabla,
          'id'=>$id,
          'Nombre' => $elemento['Nombre'],
          'Apellidos' => $elemento['Apellidos'],
          'RazonComercial' => $elemento['RazonComercial'],
          'Direccion' => $elemento['Direccion'],
          'ContactoNombre' => $elemento['ContactoNombre'],
          'Email' => $elemento['Email'],
          'Telf' => $elemento['Telf'],
          'CIF' => $elemento['CIF'],
         );
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           // comprobar campos formulario
           if ($m->modificar($tabla,$id,$_POST['Nombre'],$_POST['Apellidos'],$_POST['RazonComercial'],$_POST['Direccion'],$_POST['ContactoNombre'],$_POST['Email'],$_POST['Telf'],$_POST['CIF'])) {
                $params['mensaje'] = 'Modificado correctamente';
                $params[ 'Nombre'] = $_POST['Nombre'];
                $params[ 'Apellidos'] = $_POST['Apellidos'];
                $params[ 'RazonComercial'] = $_POST['RazonComercial'];
                $params[ 'Direccion'] = $_POST['Direccion'];
                $params[ 'ContactoNombre'] = $_POST['ContactoNombre'];
                $params[ 'Email'] = $_POST['Email'];
                $params[ 'Telf'] = $_POST['Telf'];
                $params[ 'CIF'] = $_POST['CIF'];
           } else {
               $params = array(
                'tabla'=>$tabla,
                'id'=>$id,
                'Nombre' => $elemento['Nombre'],
                'Apellidos' => $elemento['Apellidos'],
                'RazonComercial' => $elemento['RazonComercial'],
                'Direccion' => $elemento['Direccion'],
                'ContactoNombre' => $elemento['ContactoNombre'],
                'Email' => $elemento['Email'],
                'Telf' => $elemento['Telf'],
                'CIF' => $elemento['CIF'],
               );
               $params['mensaje'] = 'No se ha podido modificar. Revisa el formulario';
           }
         }
         return
          $this->render('AWifiPubBundle:Admin:formModificar.html.twig',
          $params);
    }



   public function setArticuloAction($id)
  {

      $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
        Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
      $elemento = $m->elemento("Articulos",$id);
      $params = array(
          'id'=>$id,
         'Descripcion' => $elemento['Descripcion'],
         );
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           // comprobar campos formulario
           if ($m->modificarArticulo($id,$_POST['Descripcion'])) {
               $params['mensaje'] = 'Articulo modificado correctamente';
              $params[ 'Descripcion'] = $_POST['Descripcion'];
           } else {
               $params = array(
               'id'=>$id,
               'Descripcion' => $_POST['Descripcion'],
               );
               $params['mensaje'] = 'No se ha podido modificar el articulo. Revisa el formulario';
           }
         }
         return
          $this->render('AWifiPubBundle:Admin:formModificarArticulo.html.twig',
          $params);
    }

   public function setEstadoAction($id)
  {

      $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
        Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
      $elemento = $m->elemento("Estados",$id);
      $params = array(
          'id'=>$id,
         'Descripcion' => $elemento['Descripcion'],
         );
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           // comprobar campos formulario
           if ($m->modificarEstado($id,$_POST['id'],$_POST['Descripcion'])) {
 
               $params['mensaje'] = 'Estado modificado correctamente';
               $params[ 'Descripcion'] = $_POST['Descripcion'];
               $params[ 'id'] = $_POST['id'];

           } else {
               $params = array(
               'id'=>$_POST['id'],
               'Descripcion' => $_POST['Descripcion'],
               );
               $params['mensaje'] = 'No se ha podido modificar el estado. Revisa el formulario';
           }
         }
         return
          $this->render('AWifiPubBundle:Admin:formModificarEstado.html.twig',
          $params);
    }



    public function borrarAction($tabla,$id)
    {
     $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                     Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $elemento = $m->borrar($tabla,$id);
       
        if(!$elemento)
        {
          throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
        }


      $mensaje= 'Se ha podido Borrar el '. $tabla ;
       $params = array('titulo'=>"Inicio",'mensaje' =>$mensaje,);
              return $this->render('AWifiPubBundle:Default:index.html.twig',$params);
    }
    

  public function addAction($tabla)
  {
  	$params = array(
         'tabla' =>$tabla,
         'Nombre' => '',
         'Apellido' => '',
         'razonComercial' => '',
         'Direccion' => '',
         'ContactoNombre' => '',
         'Email' => '',
         'Telf' => '',
         'CIF' => '',
         );

     $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
        Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           // comprobar campos formulario
           if ($m->insertarGenerico($tabla,$_POST['Nombre'], $_POST['Apellido'],
            $_POST['razonComercial'], $_POST['Direccion'], $_POST['ContactoNombre'], $_POST['Email'], $_POST['Telf'], $_POST['CIF'])) {
               $params['mensaje'] = $tabla.' insertado correctamente';

                return $this->forward('AWifiPubBundle:Admin:index', array(
        'tabla'  => $tabla,
        ));
           } else {
               $params = array(
                'tabla' =>$tabla,
               'Nombre' => $_POST['Nombre'],
               'Apellido' => $_POST['Apellido'],
               'razonComercial' => $_POST['razonComercial'],
               'Direccion' => $_POST['Direccion'],
               'ContactoNombre' => $_POST['ContactoNombre'],
               'Email' => $_POST['Email'],
               'Telf' => $_POST['Telf'],
               'CIF' => $_POST['CIF'],
               );
               $params['mensaje'] = 'No se ha podido insertar el '. $tabla .'. Revisa el formulario';
           }
         }

         return
          $this->render('AWifiPubBundle:Admin:formInsertar.html.twig',
          $params);
    }
     public function addArticuloAction()
  {
    $params = array(
         'Descripcion' => '',
         );

     $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
        Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           // comprobar campos formulario
           if ($m->insertarArticulo($_POST['Descripcion'])) {
               $params['mensaje'] = 'Articulo insertado correctamente';
                 return $this->forward('AWifiPubBundle:Admin:index', array(
        'tabla'  => 'Articulos',));
           } else {
               $params = array(
           
               'Descripcion' => $_POST['Descripcion'],
               );
               $params['mensaje'] = 'No se ha podido insertar el articulo. Revisa el formulario';
           }
         }

         return
          $this->render('AWifiPubBundle:Admin:formInsertarArticulo.html.twig',
          $params);
    }

     public function addEstadoAction()
  {

    $params = array(
          'id' => '',
         'Descripcion' => '',
         );

     $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
        Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           // comprobar campos formulario
           if ($m->insertarEstado($_POST['id'],$_POST['Descripcion'])) {
               $params['mensaje'] = 'Articulo insertado correctamente';
                                return $this->forward('AWifiPubBundle:Admin:index', array(
        'tabla'  => 'Estados',));
           } else {
               $params = array(
               'id' => $_POST['id'],
               'Descripcion' => $_POST['Descripcion'],
               );
               $params['mensaje'] = 'No se ha podido insertar el articulo. Revisa el formulario';
           }
         }

         return
          $this->render('AWifiPubBundle:Admin:formInsertarEstado.html.twig',
          $params);
           echo "hola";

    }


     public function addInstalacionAction()
  {
    $params = array(
         'Descripcion' => '',
         'Direccion' => '',
         'ContactoNombre' => '',
         'Direccion' => '',
         'ContactoNombre' => '',
         'Email' => '',
         'Telf' => '',
         'PosicionGPS' => '',
         'TipoInstalacion' => '',
         'TipoAccesoInternet' => '',
         'DownMbps' => '',
         'UpMbps' => '',
         );

     $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
        Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           // comprobar campos formulario
           if ($m->insertarInstalacion($_POST['Descripcion'], $_POST['Direccion'],
            $_POST['ContactoNombre'], $_POST['Direccion'], $_POST['ContactoNombre'], $_POST['Email'], $_POST['Telf'], $_POST['PosicionGPS'], $_POST['TipoInstalacion'], $_POST['TipoAccesoInternet'], $_POST['DownMbps'], $_POST['UpMbps'])) {
               $params['mensaje'] ='Instalacion insertado correctamente';

                              return $this->forward('AWifiPubBundle:Admin:index', array(
        'tabla'  => 'Instalaciones',));
           } else {
               $params = array(
               'Descripcion' => $_POST['Descripcion'],
               'Direccion' => $_POST['Direccion'],
               'ContactoNombre' => $_POST['ContactoNombre'],
               'Direccion' => $_POST['Direccion'],
               'ContactoNombre' => $_POST['ContactoNombre'],
               'Email' => $_POST['Email'],
               'Telf' => $_POST['Telf'],
               'PosicionGPS' => $_POST['PosicionGPS'],
               'TipoInstalacion' => $_POST['TipoInstalacion'],
               'TipoAccesoInternet' => $_POST['TipoAccesoInternet'],
               'DownMbps' => $_POST['DownMbps'],
               'UpMbps' => $_POST['UpMbps'],
               );
               $params['mensaje'] = 'No se ha podido insertar la Instalacion. Revisa el formulario';
           }
         }

         return
          $this->render('AWifiPubBundle:Admin:formInsertarInstalacion.html.twig',
          $params);
    }
}
