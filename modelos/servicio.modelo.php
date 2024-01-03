<?php

require_once "conexion.php";

class ModeloServicio{

    /* ===============================================
    MOSTRAR SERVICIO
    =============================================== */

    static public function mdlMostrarServicio($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

   /*  ================================================
    REGISTRO SERVICIO
    ================================================ */

    static public function mdlIngresarServicio($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, imagen, titulos, texto) 
                                                            VALUES(:codigo, :imagen, :titulos, :texto)");
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":titulos", $datos["titulos"], PDO::PARAM_STR);
        $stmt->bindParam(":texto", $datos["texto"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    /* ===============================================
    EDITAR SERVICIO
    =============================================== */

	static public function mdlEditarServicio($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                               SET  codigo = :codigo,
                                                    imagen = :imagen, 
                                                    titulos = :titulos, 
                                                    texto = :texto
                                               WHERE id_servicio = :id_servicio");

		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":titulos", $datos["titulos"], PDO::PARAM_STR);
		$stmt -> bindParam(":texto", $datos["texto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR SERVICIO
    ================================================= */

    static public function mdlBorrarServicio($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_servicio = :id_servicio");
        $stmt->bindParam(":id_servicio", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}

