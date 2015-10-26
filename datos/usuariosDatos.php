<?php

include "../entidades/usuarios.php";
include "conexion.php";

class usuariosDatos{
	function insertarUsuarios($usuario,$pass){
		$cnn = new conexion();
		$con = $cnn->conectar();
		
		$usuarios = new usuarios();
		$usuarios->usuario=$usuario;
		$usuarios->contrasena = $pass;
		mysqli_select_db($con,"formLogin");
		$sql = "INSERT INTO usuarios (usuario,contrasena) VALUES(
		'".$usuarios->usuario."',
		'".$usuarios->contrasena."'
		)";
		if(mysqli_query($con,$sql)){
			return true;
		}else{
			return false;
		}
		mysqli_close($con);
	}
    function validar($usuario,$pass){
        $cnn = new conexion();
		$con = $cnn->conectar();
		
		$usuarios = new usuarios();
		$usuarios->usuario=$usuario;
		$usuarios->contrasena = $pass;
        
		mysqli_select_db($con,"formLogin");
                
		$sql = "SELECT * FROM usuarios WHERE usuario='".$usuarios->usuario."' and contrasena='".$usuarios->contrasena."'";
        $consulta = mysqli_query($con,$sql);
        $fila = mysqli_fetch_array($consulta);
        if($fila>0){
            if($fila["usuario"] == $usuarios->usuario && $fila["contrasena"]==$usuarios->contrasena){
                return true;
            }
        }else{
            return false;
        }
    }
    
    function validarsql($usuario,$pass){
        $cnn = new conexion();
		$con = $cnn->conectarsql();
		
		$usuarios = new usuarios();
		$usuarios->usuario=$usuario;
		$usuarios->contrasena = $pass;
                //mssql_select_db('TramiteDocumentario',$con);
               $sql = "SELECT * FROM usuarios WHERE usuario='".$usuarios->usuario."' and contrasena='".$usuarios->contrasena."'";
       
               $consulta = sqlsrv_query ($con,$sql);
        $fila = sqlsrv_fetch_array ($consulta,SQLSRV_FETCH_ASSOC);
        if($fila>0){
            if(trim($fila['usuario']) == $usuarios->usuario && 
                    trim($fila['contrasena'])==$usuarios->contrasena){
                return true;
            }
        }else{
            echo 'xx';
              return false;
        }
        
    }
    
}
/*
 $cnn = new usuariosDatos();
 if ($cnn->validarsql('uno','uno')){
     echo 'bien';
 }else
 {
      echo "Conexión no se pudo establecer.<br />";
      echo 'xx';
     die( print_r( sqlsrv_errors(), true));
 }*/

?>