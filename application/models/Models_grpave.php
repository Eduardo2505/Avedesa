<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_grpave extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->db_b = $this->load->database('antecedentes', true);   
    }


    function getCountidGrpAve($idGrpAve) {


       $this->db_b->from('grpave');
       $this->db_b->where('idGrpAve', $idGrpAve);
       $num_results = $this->db_b->count_all_results();
       return $num_results;
   }

   function getUsuario() {


    return $query = $this->db_b->get('usuario');
}

function mostrarcount($usuario,$inicio,$final,$id,$calle,$colonia,$cp,$delegacion,$entidad,$fecha,$tipo) {

    $SQl = "SELECT 
    *
    FROM
    grpave
    where
    estado!='Eliminar' and calle like '%$calle%'";

    if($colonia!=""){
        $SQl .=" and colonia like '%$colonia%'";

    }
    if($cp!=""){
        $SQl .=" and cp='$cp'";

    }
    if($delegacion!=""){
        $SQl .=" and delegacion like '%$delegacion%'";

    }
    if($entidad!=""){
        $SQl .=" and entidad like '%$entidad%'";

    }
    if($fecha!=""){
        $SQl .=" and fecha='$fecha'";

    }
    if($id!=""){
        $SQl .=" and idGrpAve='$id'";

    }
    if($tipo!=""){
        $SQl .=" and tipo like '%$tipo%'";

    }

    if($usuario!=""){
        $SQl .=" and idusuario ='$usuario'";

    }

    if($inicio!=""&&$final!=""){
        $SQl .=" and registro BETWEEN '$inicio 00:00:00' AND '$final 23:59:59'";

    }

    if($inicio!=""&&$final==""){
        $SQl .=" and registro='$inicio'";

    }

    $query = $this->db_b->query($SQl);

    return $query->num_rows();
}

function mostrar($usuario,$inicio,$final,$id,$calle,$colonia,$cp,$delegacion,$entidad,$fecha,$tipo, $offset, $limin) {

    $SQl = "SELECT 
    *
    FROM
    grpave
    where
    estado!='Eliminar' and calle like '%$calle%'";

    if($colonia!=""){
        $SQl .=" and colonia like '%$colonia%'";

    }
    if($cp!=""){
        $SQl .=" and cp='$cp'";

    }
    if($delegacion!=""){
        $SQl .=" and delegacion like '%$delegacion%'";

    }
    if($entidad!=""){
        $SQl .=" and entidad like '%$entidad%'";

    }
    if($fecha!=""){
        $SQl .=" and fecha='$fecha'";

    }
    if($id!=""){
        $SQl .=" and idGrpAve='$id'";

    }
    if($tipo!=""){
        $SQl .=" and tipo like '%$tipo%'";

    }
    if($usuario!=""){
        $SQl .=" and idusuario ='$usuario'";

    }

    if($inicio!=""&&$final!=""){
        $SQl .=" and registro BETWEEN '$inicio 00:00:00' AND '$final 23:59:59'";

    }

    if($inicio!=""&&$final==""){
        $SQl .=" and registro='$inicio'";

    }



    $SQl .="  limit $offset, $limin";


    $query = $this->db_b->query($SQl);

    return $query;
}


function insertar($data) {

    $this->db_b->trans_begin();
    $this->db_b->insert('grpave', $data);

    if ($this->db_b->trans_status() === FALSE) {
        $this->db_b->trans_rollback();
        return 0;
    } else {
        $this->db_b->trans_commit();
        return 1;
    }
}


function Buscar($id) {

    $this->db_b->where('idGrpAve', $id);
    $query = $this->db_b->get('grpave');
    return $query;
}

function buscarArchivo($archivo) {

    //echo $archivo;

    $this->db_b->where('idGrpAve', $archivo);
    $query = $this->db_b->get('grpave');
    return $query->num_rows();
}

function update($id, $data) {

    $this->db_b->trans_begin();
    $this->db_b->where('idGrpAve', $id);
    $this->db_b->update('grpave', $data);

    if ($this->db_b->trans_status() === FALSE) {
        $this->db_b->trans_rollback();
    } else {
        $this->db_b->trans_commit();
    }
}


}
