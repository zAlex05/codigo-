<?php
require_once("Conexion.php");
class Publicaciones extends Conexion
{
    	public function store($usuario,$descripcion,$estado,$imagen)
    	{
    		$fecha=date('Y-m-d');
    		$hora=date('H:i:s');

    		$sql="INSERT INTO publicacion
    		      (pub_usuario,
    		      	pub_fecha,
    		      	pub_hora,
    		      	pub_descripcion,
    		      	pub_estado,
    		      	pub_imagen)
    		      values('$usuario',
    		      	'$fecha',
    		      	'$hora',
    		      	'$descripcion',
    		      	'$estado',
    		      	'$imagen')";
    		return $this->conection->query($sql);
    	}	

    	public function last_id(){
    		$result=$this->conection->query("SELECT LAST_INSERT_ID() AS pub_id ");
    		return $result->fetch_all(MYSQLI_ASSOC);
    	}

    	public function show($pub_id){
    		$result=$this->conection->query("SELECT * FROM publicacion where pub_id=$pub_id ");
    		return $result->fetch_all(MYSQLI_ASSOC);

    	}

    	public function update_img($pub_id,$fullname){
    		$result=$this->conection->query(" UPDATE publicacion set pub_imagen='$fullname' where pub_id=$pub_id ");
    	}

}


?>
