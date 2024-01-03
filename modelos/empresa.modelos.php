<?php

require_once "conexion.php";

class ModeloEmpresa{

    /* ===============================================
    MOSTRAR EMPRESA
    =============================================== */

    static public function mdlMostrarEmpresa($tabla, $item, $valor){
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
    REGISTRO DE EMPRESA
    ================================================ */

    static public function mdlIngresarEmpresa($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(icono, nombre, telefono, direccion, horario, correo, link_facebook, link_youtube) 
                                                            VALUES(:icono, :nombre, :telefono, :direccion, :horario, :correo, :link_facebook, :link_youtube)");
        $stmt->bindParam(":icono", $datos["icono"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":horario", $datos["horario"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":link_facebook", $datos["link_facebook"], PDO::PARAM_STR);
        $stmt->bindParam(":link_youtube", $datos["link_youtube"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    /* ===============================================
    EDITAR EMPRESA
    =============================================== */

	static public function mdlEditarEmpresa($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                               SET  icono = :icono, 
                                                    nombre = :nombre, 
                                                    telefono = :telefono, 
                                                    direccion = :direccion, 
                                                    horario = :horario, 
                                                    correo = :correo, 
                                                    link_facebook = :link_facebook, 
                                                    link_youtube = :link_youtube 
                                               WHERE id = :id");

		$stmt -> bindParam(":icono", $datos["icono"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":horario", $datos["horario"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":link_facebook", $datos["link_facebook"], PDO::PARAM_STR);
		$stmt -> bindParam(":link_youtube", $datos["link_youtube"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR EMPRESA
    ================================================= */

    static public function mdlBorrarEmpresa($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}

