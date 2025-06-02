<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/mantenimientoPreventivo/mantenimientoPreventivo.class.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/siga/class/admin/utilerias/util.class.php");

if(isset($_POST['accion']) && 
$_POST['accion'] !=='') {

$accion = trim($_POST['accion']);
$mantenimientoPreventivoClass = new mantenimientoPreventivo();
$utilClass                    = new util();

  if($accion==1){
    
    $agnioActual = $_POST['agnioActual'];
    $tablaArray = array();
    $info = $mantenimientoPreventivoClass->sigaTablaGlobal(1,$agnioActual);
		
    foreach($info as $item){

      $fecha = $mantenimientoPreventivoClass->sigaTablaGlobalFechas(1,$agnioActual, $item['Id_Activo'], $item['rutina']); 
							
				if($fecha[0]['Estatus_Proceso01']==4){$cierre01='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[0]['ticket01'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[0]['ticket01'].'">'.$fecha[0]['cierre01'].'</a>';}else{$cierre01='';}
				if($fecha[1]['Estatus_Proceso02']==4){$cierre02='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[1]['ticket02'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[1]['ticket02'].'">'.$fecha[1]['cierre02'].'</a>';}else{$cierre02='';}
				if($fecha[2]['Estatus_Proceso03']==4){$cierre03='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[2]['ticket03'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[2]['ticket03'].'">'.$fecha[2]['cierre03'].'</a>';}else{$cierre03='';}
				if($fecha[3]['Estatus_Proceso04']==4){$cierre04='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[3]['ticket04'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[3]['ticket04'].'">'.$fecha[3]['cierre04'].'</a>';}else{$cierre04='';}	
				if($fecha[4]['Estatus_Proceso05']==4){$cierre05='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[4]['ticket05'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[4]['ticket05'].'">'.$fecha[4]['cierre05'].'</a>';}else{$cierre05='';}	
				if($fecha[5]['Estatus_Proceso06']==4){$cierre06='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[5]['ticket06'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[5]['ticket06'].'">'.$fecha[5]['cierre06'].'</a>';}else{$cierre06='';}	
				if($fecha[6]['Estatus_Proceso07']==4){$cierre07='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[6]['ticket07'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[6]['ticket07'].'">'.$fecha[6]['cierre07'].'</a>';}else{$cierre07='';}
				if($fecha[7]['Estatus_Proceso08']==4){$cierre08='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[7]['ticket08'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[7]['ticket08'].'">'.$fecha[7]['cierre08'].'</a>';}else{$cierre08='';}
				if($fecha[8]['Estatus_Proceso09']==4){$cierre09='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[8]['ticket09'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[8]['ticket09'].'">'.$fecha[8]['cierre09'].'</a>';}else{$cierre09='';}
				if($fecha[9]['Estatus_Proceso10']==4){$cierre10='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[9]['ticket10'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[9]['ticket10'].'">'.$fecha[9]['cierre10'].'</a>';}else{$cierre10='';}
				if($fecha[10]['Estatus_Proceso11']==4){$cierre11='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[10]['ticket11'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[10]['ticket11'].'">'.$fecha[10]['cierre11'].'</a>';}else{$cierre11='';}
				if($fecha[11]['Estatus_Proceso12']==4){$cierre12='<a href="https://apps2.hospitalsatelite.com/siga/controladores/activos/siga_solicitud_tickets/Reporte-Ticket.php?Id_Solicitud='.$fecha[11]['ticket12'].'" target="_blank" style="text-decoration: none;color: black;" title="Ticket: '.$fecha[11]['ticket12'].'">'.$fecha[11]['cierre12'].'</a>';}else{$cierre12='';}

				$tablaArray[]='<tr style="border-style: solid;">';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['uPrimaria'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['uResponsable'].'</strong></td>';								
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['gestor'].'</strong></td>';	
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['Realiza'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['AF_BC'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['DescCorta'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['Modelo'].'</strong></td>';
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['NumSerie'].'</strong></td>';								
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['frecuencia'].'</strong></td>'; 
				$tablaArray[]='  <td style="font-size:11px;"><strong>'.$item['rutina'].'</strong></td>';                                
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[0]['programado01'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[0]['color01'].'text-align: center;">'.$cierre01.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[1]['programado02'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[1]['color02'].'text-align: center;">'.$cierre02.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[2]['programado03'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[2]['color03'].'text-align: center;">'.$cierre03.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[3]['programado04'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[3]['color04'].'text-align: center;">'.$cierre04.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[4]['programado05'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[4]['color05'].'text-align: center;">'.$cierre05.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[5]['programado06'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[5]['color06'].'text-align: center;">'.$cierre06.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[6]['programado07'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[6]['color07'].'text-align: center;">'.$cierre07.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[7]['programado08'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[7]['color08'].'text-align: center;">'.$cierre08.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[8]['programado09'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[8]['color09'].'text-align: center;">'.$cierre09.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[9]['programado10'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[9]['color10'].'text-align: center;">'.$cierre10.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[10]['programado11'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[10]['color11'].'text-align: center;">'.$cierre11.'</td>';
				$tablaArray[]='  <td style="background-color:#f4f4f4;text-align: center;">'.$fecha[11]['programado12'].'</td>';
				$tablaArray[]='  <td style="'.$fecha[11]['color12'].'text-align: center;">'.$cierre12.'</td>';
				$tablaArray[]='</tr>';

    }

    echo json_encode($tablaArray);
  
  } else if($accion == 2){
   
    echo json_encode('OK:'.$accion);
  } 
} else {
echo json_encode('error rutina Ajax');
}
