<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/connect/conectar.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

//================================================================================================================================================================================
class reubicacion extends conectar{
//================================================================================================================================================================================

  function ok(){
    return 'ok';
  }
  
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  function reUbicacionDeActivo($Id_Usuario_Sesion,$Id_Activo,$Id_Area,$Id_Ubic_Prim,$Id_Ubic_Sec,$Ubic_Especifica,$Centro_Costos_assist,$cmbestatusreubicacionguar,$Id_Usuario_Responsable,$Motivo_Reubicacion,$Comentarios_Reubicacion){

    $pdo = conectar::ConexionGestafSiga();
    $utilClass = new util();

    $sql01 = "SELECT AF_BC,Nombre_Activo,Id_Ubic_Prim,Id_Ubic_Sec,ISNULL(Especifica,'') Especifica,Nombre_Completo FROM siga_Activos WHERE Id_Activo=$Id_Activo";
    $sqlPrepare01 = $pdo->prepare($sql01);
    $sqlPrepare01->execute();
    $sqlResult01 = $sqlPrepare01->fetch(PDO::FETCH_NAMED);

    $sql02 = "SELECT No_Usuario,Nombre_Usuario FROM siga_usuarios WHERE Id_Usuario=$Id_Usuario_Responsable";
    $sqlPrepare02 = $pdo->prepare($sql02);
    $sqlPrepare02->execute();
    $sqlResult02 = $sqlPrepare02->fetch(PDO::FETCH_NAMED);

    $sql07 = "SELECT Nombre FROM siga_jefe_area WHERE Id_Area=$Id_Area";
    $sqlPrepare07 = $pdo->prepare($sql07);
    $sqlPrepare07->execute();
    $sqlResult07 = $sqlPrepare07->fetch(PDO::FETCH_NAMED);


    $sql03 = "UPDATE siga_Activos 
              SET Id_Area=$Id_Area,Id_Ubic_Prim=$Id_Ubic_Prim,Id_Ubic_Sec=$Id_Ubic_Sec, Id_Situacion_Activo=$cmbestatusreubicacionguar,
                  Especifica='$Ubic_Especifica',Num_Empleado=".$sqlResult02['No_Usuario'].", Nombre_Completo='".$sqlResult02['Nombre_Usuario']."',Fech_Mod=getdate(),Usr_Mod=$Id_Usuario_Sesion
              WHERE Id_Activo=$Id_Activo";
    $sqlPrepare03 = $pdo->prepare($sql03);

    $sql04 = "UPDATE siga_activos_contabilidad SET Centro_Costos=$Centro_Costos_assist WHERE Id_Activo=$Id_Activo";
    $sqlPrepare04 = $pdo->prepare($sql04);

    $sql05 = "INSERT INTO siga_reubicacion_activo (Id_Activo,Id_Area,Id_Ubic_Prim,Id_Ubic_Sec,Ubic_Especifica,Id_Usuario_Responsable,Nom_Usuario_Reponsable,Jefe_Area,Motivo_Reubicacion,Comentarios_Reubicacion,Fech_Inser,Usr_Inser,Estatus_Reg,Centro_Costos) 
              VALUES ($Id_Activo,$Id_Area,$Id_Ubic_Prim,$Id_Ubic_Sec,'$Ubic_Especifica',".$sqlResult02['No_Usuario'].",'".$sqlResult02['Nombre_Usuario']."','".$sqlResult07['Nombre']."','$Motivo_Reubicacion','$Comentarios_Reubicacion',GETDATE(),$Id_Usuario_Sesion,1,$Centro_Costos_assist)";
    $sqlPrepare05 = $pdo->prepare($sql05);

    try {
      $pdo->beginTransaction();
        $sqlPrepare05->execute();
        $id_reubicacion_activo = $pdo->lastInsertId();
        $sqlPrepare03->execute();        
        $sqlPrepare04->execute();
          $pdo->commit();
      $resultado=true;
    } catch (PDOException $e) {
      $pdo->rollBack();
      $resultado=false;
        $error='reubicacion.class.php: '.$e->getMessage();
        $utilClass->fnlog($error);
    }

    $sql06 = "INSERT INTO siga_historico_reubicacion (Id_Activo_Reubicacion,Id_Activo,Id_Area,Id_Ubic_Prim,Id_Ubic_Sec,Ubic_Especifica,FechaReubicacion,Id_Usuario,Responsable_Activo_Procedencia,id_responsable_procedencia,estatus_registro) 
              VALUES ($id_reubicacion_activo,$Id_Activo,$Id_Area,".$sqlResult01['Id_Ubic_Prim'].",".$sqlResult01['Id_Ubic_Sec'].",'".$sqlResult01['Especifica']."',getdate(),$Id_Usuario_Sesion,'".$sqlResult01['Nombre_Completo']."',$Id_Usuario_Responsable,1)";
    $sqlPrepare06 = $pdo->prepare($sql06);
    
    $sql08 = "UPDATE siga_Activos SET id_reubicacion=$id_reubicacion_activo, fch_reubicacion= GETDATE() WHERE Id_Activo=$Id_Activo";
    $sqlPrepare08= $pdo->prepare($sql08);

    try {
      $pdo->beginTransaction();
        $sqlPrepare06->execute();
        $sqlPrepare08->execute();
      $pdo->commit();
    } catch (PDOException $e) {
      $pdo->rollBack();
    $error='reubicacion.class.php:sqlPrepare06: '.$e->getMessage();
    $utilClass->fnlog($error);
    }

    $pdo=null;
    return json_encode($sqlResult01);
  }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//================================================================================================================================================================================
}
//================================================================================================================================================================================