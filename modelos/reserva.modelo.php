<?php

require_once "conexion.php";

class ModeloReserva{

    /* ===============================================
    MOSTRAR RESERVA
    =============================================== */

    static public function mdlMostrarReserva($tablaP, $tablaR, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaP INNER JOIN $tablaR ON $tablaP.id_precio = $tablaR.id_precio WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaP INNER JOIN $tablaR ON $tablaP.id_precio = $tablaR.id_precio");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

   /*  ================================================
    REGISTRO RESERVA
    ================================================ */

    static public function mdlIngresarReserva($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_precio, nombre, correo, telefono, fecha, hora, mensaje) 
                                                            VALUES(:id_precio, :nombre, :correo, :telefono, :fecha, :hora, :mensaje)");

        $stmt->bindParam(":id_precio", $datos["id_precio"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
        $stmt->bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    /* ===============================================
    EDITAR RESERVA
    =============================================== */

	static public function mdlEditarReserva($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_precio = :id_precio, nombre  = :nombre, correo = :correo, telefono = :telefono, fecha = :fecha, hora = :hora, mensaje = :mensaje WHERE id_reserva = :id_reserva");

		$stmt -> bindParam(":id_precio", $datos["id_precio"], PDO::PARAM_INT);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt -> bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
		$stmt -> bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_reserva", $datos["id_reserva"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR RESERVA
    ================================================= */

    static public function mdlBorrarReserva($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_reserva = :id_reserva");
        $stmt->bindParam(":id_reserva", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}

