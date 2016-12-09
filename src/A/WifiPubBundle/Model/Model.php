<?php

 namespace A\WifiPubBundle\Model;

 class Model
 {
     protected $conexion;

  public function __construct($dbname,$dbuser,$dbpass,$dbhost)
  {
      $mvc_bd_conexion = mysql_connect($dbhost, $dbuser, $dbpass);

      if (!$mvc_bd_conexion) {
          die('No ha sido posible realizar la conexión con la base de datos: '
          . mysql_error());
      }
      mysql_select_db($dbname, $mvc_bd_conexion);

      mysql_set_charset('utf8');

      $this->conexion = $mvc_bd_conexion;
  }

   public function bd_conexion()
   {

   }

   public function lista($tabla)
   {
    
       $sql = "select * from wifipub." . $tabla;

       $result = mysql_query($sql, $this->conexion);

       $elementos = array();
       while ($row = mysql_fetch_assoc($result))
       {
           $elementos[] = $row;
       }

       return $elementos;
   }

      public function elemento($tabla,$id)
     {
         $id = htmlspecialchars($id);
       
           $sql = "select * from wifipub." . $tabla . " where id=".$id;
      
      

         $result = mysql_query($sql, $this->conexion);

         $elemento = array();
         $row = mysql_fetch_assoc($result);

         return $row;

     }

      public function borrar($tabla,$id)
     {
         $id = htmlspecialchars($id);

          if ($tabla=="NumSerie") {
        $sql = "delete  from wifipub." . $tabla . " where NumSerie=".$id;
        }
        else
        {
           $sql = "delete  from wifipub." . $tabla . " where id=".$id;
        }
         
         $result = mysql_query($sql, $this->conexion);
         return $result;

     }
      public function columnas($tabla)
     {
         $sql = "SELECT column_name FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'wifipub' AND TABLE_NAME = '" . $tabla . "'";

       $result = mysql_query($sql, $this->conexion);

       $elementos = array();
       while ($row = mysql_fetch_assoc($result))
       {
           $elementos[] = $row;
       }

       return $elementos;

     }
    
       public function insertarGenerico($tabla,$Nombre, $Apellido, $razonComercial, $Direccion, $ContactoNombre, $Email,$Telf,$CIF)
     {
         $Nombre = htmlspecialchars($Nombre);
         $Apellido = htmlspecialchars($Apellido);
         $razonComercial = htmlspecialchars($razonComercial);
         $Direccion = htmlspecialchars($Direccion);
         $ContactoNombre = htmlspecialchars($ContactoNombre);
         $Email = htmlspecialchars($Email);
          $Telf = htmlspecialchars($Telf);
         $CIF = htmlspecialchars($CIF);

         $sql = "insert into  wifipub.". $tabla." (Nombre, Apellidos, razonComercial, Direccion,
 ContactoNombre, Email,Telf,CIF) values ('" .
                 $Nombre . "','" . $Apellido . "','" . $razonComercial . "','" . $Direccion ."','" . $ContactoNombre . "','" . $Email ."','" . $Telf ."','" . $CIF . "')";
         $result = mysql_query($sql, $this->conexion);
         return $result;
     }

         public function insertarEstado($id,$Descripcion)
     {
         $id = htmlspecialchars($id);
         $Descripcion = htmlspecialchars($Descripcion);
         $sql = "insert into  wifipub.Estados (id, Descripcion) values (" .$id . ",'" . $Descripcion . "')";
         $result = mysql_query($sql, $this->conexion);
         return $result;
     }

     public function insertarArticulo($Descripcion)
     {
         $Descripcion = htmlspecialchars($Descripcion);
         $sql = "insert into  wifipub.Articulos (Descripcion) values ('". $Descripcion . "')";
         $result = mysql_query($sql, $this->conexion);
         return $result;
     }
     public function modificarInstalacion($id,$Descripcion,$Direccion,$ContactoNombre,$PosicionGPS,$ContactoNombre,$Email,$Telf,$TipoInstalacion,$TipoAccesoInternet,$DownMbps,$UpMbps)
     {
         $Descripcion = htmlspecialchars($Descripcion);
         $PosicionGPS = htmlspecialchars($PosicionGPS);
         $TipoInstalacion = htmlspecialchars($TipoInstalacion);
         $Direccion = htmlspecialchars($Direccion);
         $ContactoNombre = htmlspecialchars($ContactoNombre);
         $Email = htmlspecialchars($Email);
         $Telf = htmlspecialchars($Telf);
         $TipoAccesoInternet = htmlspecialchars($TipoAccesoInternet);
         $DownMbps = htmlspecialchars($DownMbps);
         $UpMbps = htmlspecialchars($UpMbps);

         $sql = "update wifipub.Instalaciones set Descripcion='". $Descripcion . "',PosiciónGPS='". $PosicionGPS . "',TipoInstalacion=". $TipoInstalacion . ",Direccion='". $Direccion . "',ContactoNombre='". $ContactoNombre . "',Email='". $Email . "',Telf='". $Telf . "',DownMbps='". $DownMbps . "',UpMbps='". $UpMbps . "',TipoAccesoInternet=". $TipoAccesoInternet . " where id=". $id;
         echo $sql; 
         $result = mysql_query($sql, $this->conexion);
         return $result;
     }


       public function modificar($tabla,$id,$Nombre,$Apellidos,$razonComercial,$Direccion,$ContactoNombre,$Email,$Telf,$CIF)
     {
         $Nombre = htmlspecialchars($Nombre);
         $Apellidos = htmlspecialchars($Apellidos);
         $razonComercial = htmlspecialchars($razonComercial);
         $Direccion = htmlspecialchars($Direccion);
         $ContactoNombre = htmlspecialchars($ContactoNombre);
         $Email = htmlspecialchars($Email);
         $Telf = htmlspecialchars($Telf);
         $CIF = htmlspecialchars($CIF);

         $sql = "update wifipub.".$tabla." set Nombre='". $Nombre . "',Apellidos='". $Apellidos . "',razonComercial='". $razonComercial . "',Direccion='". $Direccion . "',ContactoNombre='". $ContactoNombre . "',Email='". $Email . "',Telf='". $Telf . "',CIF='". $CIF . "' where id=". $id;
        // echo $sql; 
         $result = mysql_query($sql, $this->conexion);
         return $result;
     }
  public function modificarArticulo($id,$Descripcion)
     {
         $Descripcion = htmlspecialchars($Descripcion);
         $sql = "update wifipub.Articulos set Descripcion='". $Descripcion . "' where id=". $id;
        // echo $sql; 
         $result = mysql_query($sql, $this->conexion);
         return $result;
     }

       public function modificarEstado($idOriginal,$id,$Descripcion)
     {
         $Descripcion = htmlspecialchars($Descripcion);
         $sql = "update wifipub.Estados set id=". $id.", Descripcion='". $Descripcion . "' where id=". $idOriginal;
          echo $sql; 
         $result = mysql_query($sql, $this->conexion);
         return $result;
     }

    public function insertarInstalacion($Descripcion, $Direccion, $ContactoNombre, $Direccion, $ContactoNombre, $Email,$Telf,$PosicionGPS,$TipoInstalacion,$TipoAccesoInternet,$DownMbps,$UpMbps)
     {

         $sql = "insert into  wifipub.Instalaciones (Descripcion, Direccion, ContactoNombre, Telf, Email,PosiciónGPS,TipoInstalacion,TipoAccesoInternet,DownMbps,UpMbps) values ('" .
                 $Descripcion . "','" . $Direccion . "','" . $ContactoNombre . "','" . $Telf ."','" . $Email ."','" . $PosicionGPS ."'," . $TipoInstalacion ."," . $TipoAccesoInternet ."," . $DownMbps ."," . $UpMbps . ")";

 //echo $sql; 
        $result = mysql_query($sql, $this->conexion);

         return $result;
     }


      public function altaRouter($fecha,$proveedor,$articulo,$doc,$numserie)
     {
         $numserie = htmlspecialchars(trim($numserie));
         $sql = "insert into  wifipub.NumSerie (NumSerie, Id_Estado,Id_Proveedor,Id_Articulo,FechaProveedor,ProveedorDoc) values ('" .$numserie . "',1,".$proveedor.",".$articulo.",FROM_UNIXTIME(". $fecha."),'" . $doc . "')";
         $result = mysql_query($sql, $this->conexion);
         return  $result;
     }
      public function cambiarEstado($fecha,$articulo,$estado,$numserie)
     {
      
        $sql = "update wifipub.NumSerie set FechaEstado=FROM_UNIXTIME(". $fecha."), Id_Estado=". $estado . ", Id_Articulo=". $articulo." where NumSerie=". $numserie;
        $result = mysql_query($sql, $this->conexion);
         return  $result;
     }

      public function entragaInstalador($articulo,$instaldor,$fecha,$doc,$numserie)
     {
      
        $sql = "update wifipub.NumSerie set Id_Instaldor=". $instaldor . ", Id_Articulo=". $articulo.",FechaInstalador=FROM_UNIXTIME(". $fecha."),InstaladorDoc='". $doc."''  where NumSerie=". $numserie;
        $result = mysql_query($sql, $this->conexion);
         return  $result;
     }

      public function instalacion($cliente,$instalacion,$fecha,$numserie)
     {
      
        $sql = "update wifipub.NumSerie set Id_Instalacion=". $instalacion . ", Id_Cliente=". $cliente.",FechaInstalación=FROM_UNIXTIME(". $fecha.") where NumSerie=". $numserie;
 //       echo $sql;
        $result = mysql_query($sql, $this->conexion);
         return  $result;
     }


   public function obtenerHistorico($id)
     {
           $sql = "select  NumSerie,Estados.Descripcion as Estado,
Articulos.Descripcion as Articulo,
FechaEstado,
Proveedores.RazonComercial as Proveedor,
FechaProveedor,
ProveedorDoc,
Instaladores.RazonComercial as Instalador,
FechaInstalador,
InstaladorDoc, 
Clientes.RazonComercial as Cliente,
Instalaciones.Descripcion as Instalación,
 FechaInstalación from wifipub.NumSerie 
left join wifipub.Estados on wifipub.Estados.Id=wifipub.NumSerie.Id_Estado 
left join wifipub.Proveedores on wifipub.Proveedores.Id=wifipub.NumSerie.Id_Proveedor 
left join wifipub.Articulos on wifipub.Articulos.Id=wifipub.NumSerie.Id_Articulo
left join wifipub.Instaladores on wifipub.Instaladores.Id=wifipub.NumSerie.Id_Instalador
left join wifipub.Clientes on wifipub.Clientes.Id=wifipub.NumSerie.Id_Cliente
left join wifipub.Instalaciones on wifipub.Instalaciones.Id=wifipub.NumSerie.Id_Instalacion 
where NumSerie='".$id."'";

     
      
//echo $sql;
         $result = mysql_query($sql, $this->conexion);

         $elemento = array();

         $row = mysql_fetch_assoc($result);

         return $row;

     }

     public function obtenerSerials($id_estado,$pag)
     {
//Nº serie, Estado Actual,Fecha estado, Proveedor, Fecha Recepción, Operador, Fecha Operación, Instalador, Fecha Entrega, Instalación, Fecha instalación,

      $sql = "select  NumSerie,Estados.Descripcion as Estado,
      FechaEstado,
      Articulos.Descripcion as Articulo,
      Proveedores.RazonComercial as Proveedor,
      FechaProveedor,
      Instaladores.RazonComercial as Instalador,
      FechaInstalador,
      Clientes.RazonComercial as Cliente,
      Instalaciones.Descripcion as Instalación,
      FechaInstalación from wifipub.NumSerie 
      left join wifipub.Estados on wifipub.Estados.Id=wifipub.NumSerie.Id_Estado 
      left join wifipub.Proveedores on wifipub.Proveedores.Id=wifipub.NumSerie.Id_Proveedor 
      left join wifipub.Articulos on wifipub.Articulos.Id=wifipub.NumSerie.Id_Articulo
      left join wifipub.Instaladores on wifipub.Instaladores.Id=wifipub.NumSerie.Id_Instalador
      left join wifipub.Clientes on wifipub.Clientes.Id=wifipub.NumSerie.Id_Cliente
      left join wifipub.Instalaciones on wifipub.Instalaciones.Id=wifipub.NumSerie.Id_Instalacion ";

      if ($id_estado>0) {
        $sql = $sql . " where id_estado=".$id_estado;
      }
      $inicio = (($pag-1)*50) ;
      $sql = $sql . " limit ". $inicio .", 50";
      //echo $sql;
      $result = mysql_query($sql, $this->conexion);

       $elementos = array();
       while ($row = mysql_fetch_assoc($result))
       {
           $elementos[] = $row;
       }

       return $elementos;
     }

       public function countSerials($id_estado)
     {

        $sql = "select count(1) as num from wifipub.NumSerie 
        left join wifipub.Estados on wifipub.Estados.Id=wifipub.NumSerie.Id_Estado 
        left join wifipub.Proveedores on wifipub.Proveedores.Id=wifipub.NumSerie.Id_Proveedor 
        left join wifipub.Articulos on wifipub.Articulos.Id=wifipub.NumSerie.Id_Articulo
        left join wifipub.Instaladores on wifipub.Instaladores.Id=wifipub.NumSerie.Id_Instalador
        left join wifipub.Clientes on wifipub.Clientes.Id=wifipub.NumSerie.Id_Cliente
        left join wifipub.Instalaciones on wifipub.Instalaciones.Id=wifipub.NumSerie.Id_Instalacion ";

        if ($id_estado>0) {
          $sql = $sql . " where id_estado=".$id_estado;
        }
      
        $result = mysql_query($sql, $this->conexion);
        $row = mysql_fetch_assoc($result);
        return $row['num'];
     }

}