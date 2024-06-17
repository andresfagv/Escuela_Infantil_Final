<?php
require_once("../../db/db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function obtenerTodosLosPadres()
{
    global $conn;
    try {
        // Preparar la consulta SQL
        $sql = "SELECT estudiante.id as idEstu, estudiante.img as imgEstu, estudiante.nombre as nomEstu, estudiante.apellido as apeEstu, GROUP_CONCAT(padre.nombre SEPARATOR '-') as nomPad, GROUP_CONCAT(padre.email SEPARATOR '-') as emailPad FROM padre JOIN estudiante ON estudiante.id=padre.id_alumno GROUP BY estudiante.id;";
        $stmt = $conn->prepare($sql);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $array_padres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $array_padres;
    } catch (Exception $e) {
        // Registrar el error
        error_log($e->getMessage());
        return false;
    }
}



function getAllClases()
{
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM clase");
        $stmt->execute();
        $array_clases = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $array_clases;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

function getAllPadres()
{
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT id FROM padre;");
        $stmt->execute();
        $array_padre = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $array_padre;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}


function enviarMensaje($idPadre, $titulo, $contenido, $idEducador)
{
    global $conn;
    $fechaHoy = date('Y-m-d');
    try {
        $stmt = $conn->prepare("INSERT INTO `mensajes` ( `id_educador`, `id_padre`, `titulo`, `contenido`, `fecha_envio`) VALUES (:idEducador, :idPadre, :titulo, :contenido, :fecha);");
        $stmt->bindParam(':idPadre', $idPadre);
        $stmt->bindParam(':idEducador', $idEducador);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':fecha', $fechaHoy);



        $stmt->execute();


        //return $array_clases;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}



function enviarMensajeAClase($claseId, $titulo, $contenido, $idEducador)
{
    // Aquí va la lógica para enviar el mensaje a una clase
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT padre.nombre AS nomPad, padre.email AS emailPad, padre.id FROM inscripcion JOIN estudiante ON inscripcion.id_estudiante = estudiante.id JOIN padre ON estudiante.id = padre.id_alumno WHERE :claseId= inscripcion.id_clase;
");
        $stmt->bindParam(':claseId', $claseId);

        $stmt->execute();

        $array_padres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($array_padres)>0){
            foreach ($array_padres as $key) {
                enviarMensaje($key['id'], $titulo, $contenido, $idEducador);
            }
        }else{
            return 'No hay niños asociados a esa clase aún';
        }


    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}
?>