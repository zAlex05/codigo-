<?php 

class Conexion
{
	public $conection;
	function __construct()
	{
		$this->conection=mysqli_connect('localhost','root','','book');
	}
}


?>
