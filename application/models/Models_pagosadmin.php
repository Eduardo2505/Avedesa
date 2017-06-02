<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Models_pagosadmin extends CI_Model {

  function __construct() {
    parent::__construct();
    $this->load->database();
  }

  function mostrapag($nombre, $offset, $limin) {

   $SQl = "SELECT 
   r.idregistro,
   r.referencia,
   r.num_expediente,
   CONCAT(e.Nombre, ' ', e.apellidos) AS inspector,
   (SELECT 
   SUM(anticipo)
   FROM
   pagos
   WHERE
   idregistro = r.idregistro and estado != 0 ) pago
   FROM
   registro r,
   empleado e,
   pagos p
   WHERE
   r.idempleado = e.idempleado and p.estado != 0 
   AND p.idregistro = r.idregistro and r.num_expediente like '%$nombre%'";


   $SQl .=" group by r.idregistro  limit $offset, $limin";
   $query = $this->db->query($SQl);

   return $query;
 }

 function mostrapagsuma($nombre) {

   $SQl = "SELECT 
   SUM(anticipo) as total
   FROM
   pagos p
   INNER JOIN
   registro r ON p.idregistro = r.idregistro
   WHERE
   estado != 0 and r.num_expediente like '%$nombre%'";

   $query = $this->db->query($SQl);

   $row = $query->row();
   return $row->total;


 }

 function mostrarcount($nombre) {

  $SQl = "SELECT 
  r.idregistro,
  r.referencia,
  r.num_expediente,
  CONCAT(e.Nombre, ' ', e.apellidos) AS inspector
  FROM
  registro r,
  empleado e,
  pagos p
  WHERE
  r.idempleado = e.idempleado and p.estado != 0
  AND p.idregistro = r.idregistro and r.num_expediente like '%$nombre%' group by r.idregistro ";

  $query = $this->db->query($SQl);

  return $query->num_rows();
}

function mostrapagsin($nombre, $offset, $limin) {

 $SQl = "SELECT 
 r.idregistro,
 r.referencia,
 r.num_expediente,
 CONCAT(e.Nombre, ' ', e.apellidos) AS inspector
 FROM
 registro r,
 empleado e
 WHERE
 r.idempleado = e.idempleado
 AND r.idregistro NOT IN (SELECT 
 r.idregistro
 FROM
 registro r,
 empleado e,
 pagos p
 WHERE
 r.idempleado = e.idempleado and p.estado != 0
 AND p.idregistro = r.idregistro) and r.num_expediente like '%$nombre%'";


 $SQl .=" group by r.idregistro order by num_expediente desc limit $offset, $limin";

 $query = $this->db->query($SQl);


 return $query;
}

function mostrarcountsin($nombre) {

  $SQl = "SELECT 
  r.idregistro,
  r.referencia,
  r.num_expediente,
  CONCAT(e.Nombre, ' ', e.apellidos) AS inspector
  FROM
  registro r,
  empleado e
  WHERE
  r.idempleado = e.idempleado
  AND r.idregistro NOT IN (SELECT 
  r.idregistro
  FROM
  registro r,
  empleado e,
  pagos p
  WHERE
  r.idempleado = e.idempleado and p.estado != 0 
  AND p.idregistro = r.idregistro) and r.num_expediente like '%$nombre%' group by r.idregistro ";

  $query = $this->db->query($SQl);

  return $query->num_rows();
}




function mostrarpagos($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$autorizado, $offset, $limin) {

 $SQl = "SELECT 
 r.num_expediente,
 p.anticipo,
 p.idregistro,
 p.descripcion,
 p.registro registropago,
 p.usuario usuariopago,
 IFNULL(pa.usuario, 'PENDIENTE') AS usuarioAceptacion,
 IFNULL(pa.registro, 'PENDIENTE') AS registroAceptacion
 FROM
 pagos p
 INNER JOIN
 registro r ON p.idregistro = r.idregistro
 LEFT JOIN
 pagosaceptados pa ON p.idpagos = pa.idpagos
 WHERE
 p.estado != 0 ";

 if($autorizado!=""){
  if($autorizado=='PENDIENTE'){

    $SQl .=" and  IFNULL(pa.usuario, 'PENDIENTE') ='$autorizado' ";
  }else{
    $SQl .=" and  IFNULL(pa.usuario, 'PENDIENTE') !='PENDIENTE' ";
  }
}
if($numexpediente!=""){

  $SQl .=" and  r.num_expediente='$numexpediente'";
}
if($inicior!=""&&$finalr==""){

  $SQl .=" and CAST(p.registro AS DATE) ='$inicior'";
}

if($inicior==""&&$finalr!=""){

  $SQl .=" and CAST(p.registro AS DATE) ='$finalr'";
}
if($inicior!=""&&$finalr!=""){

  $SQl .=" and p.registro BETWEEN '$inicior 00:00:00' and '$finalr 23:59:59'";
}


if($inicioa!=""&&$finala==""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$inicioa'";
}

if($inicioa==""&&$finala!=""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$finala'";
}
if($inicioa!=""&&$finala!=""){

  $SQl .=" and pa.registro BETWEEN '$inicioa 00:00:00' and '$finala 23:59:59'";
}

if($usuario!=""){

  $SQl .=" and p.usuario ='".str_replace('-',' ',$usuario)."'  ";
}

$SQl.="ORDER BY p.registro DESC  limit $offset, $limin";


$query = $this->db->query($SQl);

return $query;
}


function mostrarpagosSuma($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$autorizado) {

 $SQl = "SELECT 
 SUM(p.anticipo) as total
 FROM
 pagos p
 INNER JOIN
 registro r ON p.idregistro = r.idregistro
 LEFT JOIN
 pagosaceptados pa ON p.idpagos = pa.idpagos
 WHERE
 p.estado != 0 ";

 if($autorizado!=""){
  if($autorizado=='PENDIENTE'){

    $SQl .=" and  IFNULL(pa.usuario, 'PENDIENTE') ='$autorizado' ";
  }else{
    $SQl .=" and  IFNULL(pa.usuario, 'PENDIENTE') !='PENDIENTE' ";
  }
}
if($numexpediente!=""){

  $SQl .=" and  r.num_expediente='$numexpediente'";
}
if($inicior!=""&&$finalr==""){

  $SQl .=" and CAST(p.registro AS DATE) ='$inicior'";
}

if($inicior==""&&$finalr!=""){

  $SQl .=" and CAST(p.registro AS DATE) ='$finalr'";
}
if($inicior!=""&&$finalr!=""){

  $SQl .=" and p.registro BETWEEN '$inicior 00:00:00' and '$finalr 23:59:59'";
}


if($inicioa!=""&&$finala==""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$inicioa'";
}

if($inicioa==""&&$finala!=""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$finala'";
}
if($inicioa!=""&&$finala!=""){

  $SQl .=" and pa.registro BETWEEN '$inicioa 00:00:00' and '$finala 23:59:59'";
}

if($usuario!=""){

  $SQl .=" and p.usuario ='".str_replace('-',' ',$usuario)."'  ";
}



$query = $this->db->query($SQl);

$row = $query->row();
return $row->total;
}

function countpagos($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$autorizado) {

  $SQl = "SELECT 
  r.num_expediente,
  p.anticipo,
  p.idregistro,
  p.descripcion,
  p.registro registropago,
  p.usuario usuariopago,
  IFNULL(pa.usuario, 'PENDIENTE') AS usuarioAceptacion,
  IFNULL(pa.registro, 'PENDIENTE') AS registroAceptacion
  FROM
  pagos p
  INNER JOIN
  registro r ON p.idregistro = r.idregistro
  LEFT JOIN
  pagosaceptados pa ON p.idpagos = pa.idpagos
  WHERE
  p.estado != 0 ";


  if($autorizado!=""){
    if($autorizado=='PENDIENTE'){

      $SQl .=" and  IFNULL(pa.usuario, 'PENDIENTE') ='$autorizado'";
    }else{
      $SQl .=" and  IFNULL(pa.usuario, 'PENDIENTE') !='PENDIENTE'";
    }
  }

  if($numexpediente!=""){

    $SQl .=" and  r.num_expediente='$numexpediente'";
  }
  if($inicior!=""&&$finalr==""){

    $SQl .=" and CAST(p.registro AS DATE) ='$inicior'";
  }

  if($inicior==""&&$finalr!=""){

    $SQl .=" and CAST(p.registro AS DATE) ='$finalr'";
  }
  if($inicior!=""&&$finalr!=""){

    $SQl .=" and p.registro BETWEEN '$inicior 00:00:00' and '$finalr 23:59:59'";
  }


  if($inicioa!=""&&$finala==""){

    $SQl .=" and CAST(pa.registro AS DATE) ='$inicioa'";
  }

  if($inicioa==""&&$finala!=""){

    $SQl .=" and CAST(pa.registro AS DATE) ='$finala'";
  }
  if($inicioa!=""&&$finala!=""){

    $SQl .=" and pa.registro BETWEEN '$inicioa 00:00:00' and '$finala 23:59:59'";
  }

  if($usuario!=""){


   $SQl .=" and p.usuario ='".str_replace('-',' ',$usuario)."'  ";
 }



 $query = $this->db->query($SQl);

 return $query->num_rows();
}


function mostrarpagosEliminados($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$offset, $limin) {

 $SQl = "SELECT 
 r.num_expediente,
 p.anticipo,
 p.idregistro,
 p.descripcion,
 p.registro registropago,
 p.usuario usuariopago,
 IFNULL(pa.usuario, 'PENDIENTE') AS usuarioAceptacion,
 IFNULL(pa.registro, 'PENDIENTE') AS registroAceptacion
 FROM
 pagos p
 INNER JOIN
 registro r ON p.idregistro = r.idregistro
 INNER JOIN
 pagoseliminados pa ON p.idpagos = pa.idpagos
 WHERE
 p.estado = 0 ";

 if($numexpediente!=""){

  $SQl .=" and  r.num_expediente='$numexpediente'";
}
if($inicior!=""&&$finalr==""){

  $SQl .=" and CAST(p.registro AS DATE) ='$inicior'";
}

if($inicior==""&&$finalr!=""){

  $SQl .=" and CAST(p.registro AS DATE) ='$finalr'";
}
if($inicior!=""&&$finalr!=""){

  $SQl .=" and p.registro BETWEEN '$inicior 00:00:00' and '$finalr 23:59:59'";
}


if($inicioa!=""&&$finala==""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$inicioa'";
}

if($inicioa==""&&$finala!=""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$finala'";
}
if($inicioa!=""&&$finala!=""){

  $SQl .=" and pa.registro BETWEEN '$inicioa 00:00:00' and '$finala 23:59:59'";
}

if($usuario!=""){

  $SQl .=" and p.usuario ='".str_replace('-',' ',$usuario)."'  ";
}

$SQl .="ORDER BY p.registro DESC  limit $offset, $limin";


$query = $this->db->query($SQl);

return $query;
}

function countpagosEliminados($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario) {

 $SQl = "SELECT 
 r.num_expediente,
 p.anticipo,
 p.idregistro,
 p.descripcion,
 p.registro registropago,
 p.usuario usuariopago,
 IFNULL(pa.usuario, 'PENDIENTE') AS usuarioAceptacion,
 IFNULL(pa.registro, 'PENDIENTE') AS registroAceptacion
 FROM
 pagos p
 INNER JOIN
 registro r ON p.idregistro = r.idregistro
 INNER JOIN
 pagoseliminados pa ON p.idpagos = pa.idpagos
 WHERE
 p.estado = 0 ";

 if($numexpediente!=""){

  $SQl .=" and  r.num_expediente='$numexpediente'";
}
if($inicior!=""&&$finalr==""){

  $SQl .=" and CAST(p.registro AS DATE) ='$inicior'";
}

if($inicior==""&&$finalr!=""){

  $SQl .=" and CAST(p.registro AS DATE) ='$finalr'";
}
if($inicior!=""&&$finalr!=""){

  $SQl .=" and p.registro BETWEEN '$inicior 00:00:00' and '$finalr 23:59:59'";
}


if($inicioa!=""&&$finala==""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$inicioa'";
}

if($inicioa==""&&$finala!=""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$finala'";
}
if($inicioa!=""&&$finala!=""){

  $SQl .=" and pa.registro BETWEEN '$inicioa 00:00:00' and '$finala 23:59:59'";
}

if($usuario!=""){

  $SQl .=" and p.usuario ='".str_replace('-',' ',$usuario)."'  ";
}

$query = $this->db->query($SQl);

return $query->num_rows();
}

function mostraUsuarios() {

 $SQl = "SELECT 
 p.usuario usuariopago
 FROM
 pagos p
 INNER JOIN
 registro r ON p.idregistro = r.idregistro
 LEFT JOIN
 pagosaceptados pa ON p.idpagos = pa.idpagos
 WHERE
 p.estado != 0  group by p.usuario";


 $query = $this->db->query($SQl);

 return $query;
}

function mostrarpagosticket($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario) {

 $SQl = "SELECT 
 r.num_expediente,
 p.anticipo,
 p.idregistro,
 p.descripcion,
 p.registro registropago,
 p.usuario usuariopago,
 p.idpagos,
 IFNULL(pa.usuario, 'PENDIENTE') AS usuarioAceptacion,
 IFNULL(pa.registro, 'PENDIENTE') AS registroAceptacion
 FROM
 pagos p
 INNER JOIN
 registro r ON p.idregistro = r.idregistro
 LEFT JOIN
 pagosaceptados pa ON p.idpagos = pa.idpagos
 WHERE
 p.estado != 0 and  p.estado != 2 ";

 if($numexpediente!=""){

  $SQl .=" and  r.num_expediente='$numexpediente'";
}
if($inicior!=""&&$finalr==""){

  $SQl .=" and CAST(p.registro AS DATE) ='$inicior'";
}

if($inicior==""&&$finalr!=""){

  $SQl .=" and CAST(p.registro AS DATE) ='$finalr'";
}
if($inicior!=""&&$finalr!=""){

  $SQl .=" and p.registro BETWEEN '$inicior 00:00:00' and '$finalr 23:59:59'";
}


if($inicioa!=""&&$finala==""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$inicioa'";
}

if($inicioa==""&&$finala!=""){

  $SQl .=" and CAST(pa.registro AS DATE) ='$finala'";
}
if($inicioa!=""&&$finala!=""){

  $SQl .=" and pa.registro BETWEEN '$inicioa 00:00:00' and '$finala 23:59:59'";
}

if($usuario!=""){

  $SQl .=" and p.usuario ='".str_replace('-',' ',$usuario)."'  ";
}

$SQl .="ORDER BY p.registro";
//echo $SQl;

$query = $this->db->query($SQl);

return $query;
}

function insertarPagos($data) {

  $this->db->trans_begin();
  $this->db->insert('pagosaceptados', $data);

  if ($this->db->trans_status() === FALSE) {
    $this->db->trans_rollback();
    return 0;
  } else {
    $this->db->trans_commit();
    return 1;
  }
}

function mostrarpagosticketAceptar($folio) {

 $SQl = "SELECT 
 r.num_expediente, p.anticipo, pa.registro, p.usuario,pa.idpagosaceptados
 FROM
 pagosaceptados pa
 INNER JOIN
 pagos p ON pa.idpagos = p.idpagos
 INNER JOIN
 registro r ON r.idregistro = p.idregistro
 AND impreso = 0 and p.estado != 0 and tiket='$folio'";

 $query = $this->db->query($SQl);

 return $query;
}



function updatePagosAceptados($id, $data) {

  $this->db->trans_begin();
  $this->db->where('idpagosaceptados', $id);
  $this->db->update('pagosaceptados', $data);

  if ($this->db->trans_status() === FALSE) {
    $this->db->trans_rollback();
  } else {
    $this->db->trans_commit();
  }
}

function updatePagos($id, $data) {

  $this->db->trans_begin();
  $this->db->where('idpagos', $id);
  $this->db->update('pagos', $data);

  if ($this->db->trans_status() === FALSE) {
    $this->db->trans_rollback();
  } else {
    $this->db->trans_commit();
  }
}



}