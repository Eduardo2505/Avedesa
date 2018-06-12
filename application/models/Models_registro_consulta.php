<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_registro_consulta extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model('models_c_entidades_municipios');
    }

    function reporteExcel($obj) {

        $SQl = "SELECT DISTINCT
        r.idregistro,
        r.referencia,
        r.telefono,
        r.email,
        ta.nombre nomtipoava,
        oa.nombre nomobjetivo,
        r.otros,
        r.ubicacion,
        r.costo,
        r.fecha_de_inspeccion,
        r.hora_de_inspeccion,
        e.Nombre,
        e.apellidos,
        e.color,
        e.idempleado,
        r.monto_credito,
        r.monto_venta,
        r.observaciones,
        r.fecha_asigancion,
        r.fecha_captura,
        r.fecha_cierre,
        r.registro_inicial,
        r.registro,
        r.fecha_final,
        r.intermediario nomIntermediria,
        r.adelanto_pago,
        r.num_expediente,
        r.idestado_registro,
        r.tipoRegistro,
        r.tipoSnc,
        er.estado,
        (select 
        concat(Nombre, ' ', apellidos)
        from
        empleado
        where
        idempleado = r.idcapturista) as capturista,
        (select 
        concat(Nombre, ' ', apellidos)
        from
        empleado
        where
        idempleado = e.idempleado) as inspector,
        r.num_avaluo,
        r.fecha_de_entrega,
        r.estado_fecha
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%$obj->numExpediente%' limit 1500";
        
        $SQl .= $this->filtros($obj);

        $query = $this->db->query($SQl);

        return $query;
    }
    

    function mostrar($obj,$offset, $limin) {

        $SQl = "SELECT DISTINCT
        r.idregistro,
        r.referencia,
        r.telefono,
        r.email,
        ta.nombre nomtipoava,
        oa.nombre nomobjetivo,
        r.otros,
        r.ubicacion,
        r.costo,
        r.fecha_de_inspeccion,
        r.hora_de_inspeccion,
        e.Nombre,
        e.apellidos,
        e.color,
        e.idempleado,
        r.monto_credito,
        r.monto_venta,
        r.observaciones,
        r.fecha_asigancion,
        r.fecha_captura,
        r.fecha_cierre,
        r.registro_inicial,
        r.registro,
        r.fecha_final,
        r.intermediario nomIntermediria,
        r.adelanto_pago,
        r.num_expediente,
        r.idestado_registro,
        r.tipoRegistro,
        r.tipoSnc,
        er.estado,
        (select 
        concat(Nombre, ' ', apellidos)
        from
        empleado
        where
        idempleado = r.idcapturista) as capturista,
        (select 
        concat(Nombre, ' ', apellidos)
        from
        empleado
        where
        idempleado = e.idempleado) as inspector,
        r.num_avaluo,
        r.fecha_de_entrega,
        r.estado_fecha
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%$obj->numExpediente%' ";
        
        $SQl .= $this->filtros($obj);
        $SQl .=" order by r.idregistro desc limit $offset, $limin";
        $query = $this->db->query($SQl);

       // echo $SQl;

        return $query;
    }

    function mostrarcount($obj) {

        $SQl = "SELECT DISTINCT  
        r.idregistro
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%$obj->numExpediente%' ";        
        $SQl .= $this->filtros($obj);

       // echo $SQl;
        $query = $this->db->query($SQl);

        return $query->num_rows();

    }


    function filtros($obj) {


        $SQl="";

        if($obj->tipoSnc!=-1){
         $SQl .=" and r.tipoSnc=$obj->tipoSnc";
     }
     if ($obj->id != "") {
        $SQl .=" and r.idregistro=$obj->id";
    }
    if ($obj->folio_cliente != "") {
      $SQl .=" and r.num_avaluo like '%$obj->folio_cliente%'";
  }

  if ($obj->costo != 0) {
    $SQl .=" and r.costo=$obj->costo";
}

if ($obj->idOperador != "") {
    $SQl .=" and r.idOperador=$obj->idOperador";
}

if ($obj->idInsepctor != "") {
    $SQl .=" and r.idempleado=$obj->idInsepctor";
}

if ($obj->idEjecutivo != "") {
    $SQl .=" and r.id_asigno=$obj->idEjecutivo";
}

if ($obj->objetivoAvaluo != "") {
    $SQl .=" and r.idobjetivo_avaluo=$obj->objetivoAvaluo";
}

if ($obj->reporteTesoreria != "") {
    $SQl .=" and r.reporteTesoreria=$obj->reporteTesoreria";
}

if ($obj->idIntemediario != "") {

    if($obj->idIntemediario==-1) {
     $SQl .=" and r.intermediario='$obj->otro_intermediario'";

 }else{

     $SQl .=" and r.clave='$obj->idIntemediario'";

 }

}
if ($obj->otros != "") {
 $SQl .=" and r.otros like '%$obj->otros%'";
}
if ($obj->nomRefer != "") {
 $SQl .=" and v.ContactoVisita like '%$obj->nomRefer%'";
}

if ($obj->fecha_visita != "") {
    $SQl .=" and r.fecha_de_inspeccion='$obj->fecha_visita'";
}

if($obj->visita_exitosa!=-1){
   $SQl .=" and v.VisitaExitosa=$obj->visita_exitosa";
}

if ($obj->telefono_v != "") {
    $SQl .=" and v.Telefono='$obj->telefono_v'";
}
if ($obj->telefono_v2 != "") {
    $SQl .=" and r.telefono like '%$obj->telefono_v2%'";
}
if ($obj->email_v != "") {
    $SQl .=" and r.email like '%$obj->email_v%'";
}

if ($obj->monto_credito != 0) {
    $SQl .=" and r.monto_credito=$obj->monto_credito";
}

if ($obj->monto_venta != 0) {
    $SQl .=" and r.monto_venta=$obj->monto_venta";
}
if ($obj->observaciones != "") {
    $SQl .=" and r.observaciones like '%$obj->observaciones%'";
}
if ($obj->usuario_entrega != "") {
    $SQl .=" and r.usuario_entrega like '%$obj->usuario_entrega%'";
}
                //solicitante
if ($obj->nombre_s != "") {
    $SQl .=" and s.Nombre like '%$obj->nombre_s%'";
}
if ($obj->p_apellido_s != "") {
    $SQl .=" and s.ApellidoPaterno like '%$obj->p_apellido_s%'";
}
if ($obj->s_apellido_s != "") {
    $SQl .=" and s.ApellidoMaterno like '%$obj->s_apellido_s%'";
}
if ($obj->tipo_persona_s != "") {
    $SQl .=" and s.PersonaMoral like '%$obj->tipo_persona_s%'";
}
if ($obj->rfc_s != "") {
    $SQl .=" and s.Rfc like '%$obj->rfc_s%'";
}
if ($obj->nss_s != "") {
 $SQl .=" and s.Nss like '%$obj->nss_s%'";
}
if($obj->cp_s!=""){
  $SQl .=" and s.CodigoPostal='$obj->cp_s'";
}
if ($obj->col_s != "") {
    $SQl .=" and s.Colonia like '%$obj->col_s%'";
}
$nombreEstado="";
$nombreMuni="";
if($obj->idEntidad_s!=""){
    $SQl .=" and s.ClaveEntidad=$obj->idEntidad_s";
    $nombreEstado=$this->models_c_entidades_municipios->getNombreEstado($obj->idEntidad_s);
    $SQl .=" and r.ubicacion like '%$nombreEstado%'";
}
if($obj->id_muni_s!=""){
    $SQl .=" and s.ClaveMunicipio=$obj->id_muni_s";
    $nombreMuni=$this->models_c_entidades_municipios->getNombreMunicipio($obj->idEntidad_s,$obj->id_muni_s);
    $SQl .=" and r.ubicacion like '%$nombreMuni%'";
}

if($obj->calle_s!=""){
    $SQl .=" and s.Calle like '%$obj->calle_s%'";
    $SQl .=" and r.ubicacion like '%$obj->calle_s%'";
}
if($obj->num_ext_s!=""){
    $SQl .=" and s.NumeroExterior like '%$obj->num_ext_s%'";
    $SQl .=" and r.ubicacion like '%$obj->num_ext_s%'";
}
if($obj->num_int_s!=""){
    $SQl .=" and s.NumeroInterior like '%$obj->num_int_s%'";
    $SQl .=" and r.ubicacion like '%$obj->num_int_s%'";
}
if($obj->telefono_s!=""){
    $SQl .=" and s.Telefono like '%$obj->telefono_s%'";
}

if($obj->email_s!=""){
    $SQl .=" and s.CorreoElectronico like '%$obj->email_s%'";
}
//inmueble//
if($obj->idtipo_avaluo_i!=""){
    $SQl .=" and i.idtipoInmueble like '%$obj->idtipo_avaluo_i%'";
}

if($obj->cp_i!=""){
  $SQl .=" and i.CodigoPostal='$obj->cp_i'";
}
if($obj->col_i!=""){
    $SQl .=" and i.Colonia like '%$obj->col_i%'";
}

if($obj->idEntidad_i!=-1){
    $SQl .=" and i.ClaveEntidad=$obj->idEntidad_i";

}
if($obj->id_muni_i!=-1){
    $SQl .=" and i.ClaveMunicipio=$obj->id_muni_i";

}

if($obj->calle_i!=""){
    $SQl .=" and i.Calle like '%$obj->calle_i%'";

}
if($obj->num_ex_i!=""){
    $SQl .=" and i.NumeroExterior like '%$obj->num_ex_i%'";

}
if($obj->num_int_i!=""){
    $SQl .=" and i.NumeroInterior like '%$obj->num_int_i%'";

}

if($obj->mz_i!=""){
    $SQl .=" and i.Manzana like '%$obj->mz_i%'";

}

if($obj->lt_i!=""){
    $SQl .=" and i.Lote like '%$obj->lt_i%'";

}

if($obj->condominio_i!=""){
    $SQl .=" and i.Condominio like '%$obj->condominio_i%'";

}

if($obj->entrada_i!=""){
    $SQl .=" and i.Entrada like '%$obj->entrada_i%'";

}

if($obj->edificio_i!=""){
    $SQl .=" and i.Edificio like '%$obj->edificio_i%'";

}

if($obj->depto_i!=""){
    $SQl .=" and i.Departamento like '%$obj->depto_i%'";

}

if($obj->entre_calle_i!=""){
    $SQl .=" and i.EntreCalle like '%$obj->entre_calle_i%'";

}

if($obj->yCalle_i!=""){
    $SQl .=" and i.YCalle like '%$obj->yCalle_i%'";

}
if($obj->ciudad_i!=""){
    $SQl .=" and i.Ciudad like '%$obj->ciudad_i%'";

}

if ($obj->fecha_de_inspeccion_inicio != "" && $obj->fecha_de_inspeccion_final != "") {
    $SQl .=" and r.fecha_de_inspeccion BETWEEN '$obj->fecha_de_inspeccion_inicio' and '$obj->fecha_de_inspeccion_final'";
}

if ($obj->fecha_de_entrega_inicial != "" && $obj->fecha_de_entrega_finali != "") {
    $SQl .=" and r.fecha_de_entrega BETWEEN '$obj->fecha_de_entrega_inicial' and '$obj->fecha_de_entrega_finali'";
}
if ($obj->fecha_asigancion_inicial != "" && $obj->fecha_asigancion_finali != "") {
    $SQl .=" and r.fecha_asigancion BETWEEN '$obj->fecha_asigancion_inicial' and '$obj->fecha_asigancion_finali'";
}

if ($obj->fecha_captura_inicial != "" && $obj->fecha_captura_finali != "") {
    $SQl .=" and r.fecha_captura BETWEEN '$obj->fecha_captura_inicial' and '$obj->fecha_captura_finali'";
}
if ($obj->fecha_cierre_inicial != "" && $obj->fecha_cierre_finali != "") {
    $SQl .=" and r.fecha_cierre BETWEEN '$obj->fecha_cierre_inicial' and '$obj->fecha_cierre_finali'";
}
if ($obj->registro_inicial_inicial != "" && $obj->registro_inicial_finali != "") {
    $SQl .=" and r.registro_inicial BETWEEN '$obj->registro_inicial_inicial' and '$obj->registro_inicial_finali'";
}


return $SQl;
}




}