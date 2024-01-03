<?php

require_once "conexion.php";

class ModeloSusccriptor{

    /* ===============================================
    MOSTRAR SUSCRIPTOR
    =============================================== */

    static public function mdlMostrarSuscriptor($tabla,$item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by id DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by id DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

   /*  ================================================
    REGISTRO SUSCRIPTOR
    ================================================ */

    static public function mdlIngresarSuscriptor($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(correo) 
                                                            VALUES(:correo)");

        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }


   /*  =================================================
    BORRAR SUSCRIPTOR
    ================================================= */

    static public function mdlBorrarSuscriptor($tabla, $datos){
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

