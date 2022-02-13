<?php
    function datosUsuario($iduser){
        include 'conexionDb.php';
        $query = "SELECT * FROM usuario WHERE iduser = '$iduser'";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    
    function localidad($iduser){
        include 'conexionDb.php';
        $query = "SELECT localidad.localidad AS locnom FROM usuario, localidad WHERE usuario.iduser = '$iduser' AND localidad.idloc = usuario.localidad";
        $result = mysqli_query($conexion, $query);
        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);
            $locnom = $row['locnom'];
        }
        return $locnom;
    }

    function departamento($iduser){
        include 'conexionDb.php';
        $query = "SELECT departamento.departamento AS depnom FROM usuario, departamento WHERE usuario.iduser='$iduser' AND departamento.idep = usuario.departamento";
	    $result = mysqli_query($conexion, $query);
		if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
            $depnom = $row['depnom'];
		}
        return $depnom;
    }
    
    function provincia($iduser){
        include 'conexionDb.php';
        $query = "SELECT provincia.provincia AS provnom FROM usuario, provincia WHERE usuario.iduser='$iduser' AND provincia.idpro = usuario.provincia";
		$result = mysqli_query($conexion, $query);
	    if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);
		    $provnom = $row['provnom'];
        }
        return $provnom;
    }
    function pais($iduser){
        include 'conexionDb.php';
        $query = "SELECT pais.pais AS paisnom FROM usuario, pais WHERE usuario.iduser='$iduser' AND pais.idpais = usuario.idpais";
		$result = mysqli_query($conexion, $query);
		if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
			$paisnom = $row['paisnom'];
		}
        return $paisnom;
    }

    function carrera($iduser){
        include 'conexionDb.php';
        $id = mysqli_query($conexion, "SELECT idloc FROM usuario WHERE iduser='$iduser'");
        $id = mysqli_fetch_assoc($id);
        $id = $id['idloc'];
        $query = "SELECT carrera.carrera FROM carrera, carxuser WHERE carxuser.iduser='$id' AND carxuser.idcar=carrera.idcar";
		$result = mysqli_query($conexion, $query);
		if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
			$carrera = $row['carrera'];
		}
        return $carrera;
    }

    function idiomasbd($iduser){
        require('conexionDb.php');
        $datos = mysqli_query($conexion, "SELECT idiomas.idioma FROM idioxuser, idiomas, usuario WHERE usuario.iduser='$iduser' AND idiomas.idi = idioxuser.idi");
        $x=0;
        $result = array();
        while ($fila = mysqli_fetch_row($datos)) {
            $result[$x]=$fila[0];
            $x++;            
        }
        return $result;
    }

    function experiencia($iduser){
        require('conexionDb.php');
        $query = "SELECT * FROM experiencia WHERE iduser='$iduser'";
        $result = mysqli_query($conexion, $query);/*
        while ($fila = mysqli_fetch_assoc($result)) {
            echo $fila["puesto"] . " en la empresa " . $fila["empresa"] . ", desde " . $fila["desde"] . ", hasta " . $fila["hasta"] . "<br>";          
        }*/
        return $result;
    }
    function foto($iduser){
        require('conexionDb.php');
        $query = "SELECT foto FROM usuario WHERE iduser='$iduser'";
        $result = mysqli_query($conexion, $query);
        if (!$result) {
            die('Query failed!'. mysqli_error($conexion));
        }
        $fila = mysqli_fetch_row($result);
        if(!empty($fila[0])){
            $foto = "../db/images/" . $fila[0];
        }else{
            $foto = "../db/images/default.png";
        }             
                   
        return $foto;
    }
    
?>