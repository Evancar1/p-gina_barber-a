<?php

require_once "conexion.php";

class ModeloSEO{

    /* ===============================================
    MOSTRAR EMPRESA
    =============================================== */

    static public function mdlMostrarSEO($tabla, $item, $valor){
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

    static public function mdlIngresarSEO($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(meta_desc, meta_palabra_clave, meta_autor) 
                                                            VALUES(:meta_desc, :meta_palabra_clave, :meta_autor)");
        $stmt->bindParam(":meta_desc", $datos["meta_desc"], PDO::PARAM_STR);
        $stmt->bindParam(":meta_palabra_clave", $datos["meta_palabra_clave"], PDO::PARAM_STR);
        $stmt->bindParam(":meta_autor", $datos["meta_autor"], PDO::PARAM_STR);

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

	static public function mdlEditarSEO($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                               SET  meta_desc = :meta_desc, 
                                                    meta_palabra_clave = :meta_palabra_clave, 
                                                    meta_autor = :meta_autor 
                                               WHERE id_seo = :id_seo");

		$stmt -> bindParam(":meta_desc", $datos["meta_desc"], PDO::PARAM_STR);
		$stmt -> bindParam(":meta_palabra_clave", $datos["meta_palabra_clave"], PDO::PARAM_STR);
		$stmt -> bindParam(":meta_autor", $datos["meta_autor"], PDO::PARAM_STR);

		$stmt -> bindParam(":id_seo", $datos["id_seo"], PDO::PARAM_INT);

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

    static public function mdlBorrarSEO($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_seo = :id_seo");
        $stmt->bindParam(":id_seo", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}

