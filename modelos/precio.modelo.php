<?php

require_once "conexion.php";

class ModeloPrecio{

    /* ===============================================
    MOSTRAR PRECIO
    =============================================== */

    static public function mdlMostrarPrecio($tablaS, $tablaP, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaS INNER JOIN $tablaP ON $tablaS.id_servicio = $tablaP.id_servicio WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaS INNER JOIN $tablaP ON $tablaS.id_servicio = $tablaP.id_servicio");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

   /*  ================================================
    REGISTRO PRECIO
    ================================================ */

    static public function mdlIngresarPrecio($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_servicio, imagen, titulop, descripcion, precio) 
                                                            VALUES(:codigo, :id_servicio, :imagen, :titulop, :descripcion, :precio)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":titulop", $datos["titulop"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    /* ===============================================
    EDITAR PRECIO
    =============================================== */

	static public function mdlEditarPrecio($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, id_servicio  = :id_servicio, imagen = :imagen, titulop = :titulop, descripcion = :descripcion, precio = :precio WHERE id_precio = :id_precio");

		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":titulop", $datos["titulop"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_precio", $datos["id_precio"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR PRECIO
    ================================================= */

    static public function mdlBorrarPrecio($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_precio = :id_precio");
        $stmt->bindParam(":id_precio", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}

