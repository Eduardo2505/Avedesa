<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_archivos extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

       $this->db->trans_begin();
       $this->db->insert('archivos', $data);

       if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();
      }  else {
        $this->db->trans_commit();
    }



}

function update($id, $data) {

    $this->db->trans_begin();
    $this->db->where('idarchivos', $id);
    $this->db->update('archivos', $data);

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
    } else {
        $this->db->trans_commit();
    }
}

function eliminar($id) {

    $this->db->trans_begin();
    $this->db->where('idarchivos', $id);
    $this->db->delete('archivos');

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
    } else {
        $this->db->trans_commit();
    }
}
function carSer() {

    $this->db->where('dropbox', 0);
    return $query = $this->db->get('archivos');
}

function get() {

    $this->db->where('dropbox', 1);
    return $query = $this->db->get('archivos');
}

function mostrarcount($nombre, $idregistro, $tipo) {

    $SQl = "SELECT * FROM archivos where descripcion like '%$nombre%' and estado=1 and idregistro=$idregistro and tipo=$tipo ";

    $query = $this->db->query($SQl);

    return $query->num_rows();
}

function mostrar($nombre, $idregistro, $tipo, $offset, $limin) {


    $SQl = "SELECT * FROM archivos where descripcion like '%$nombre%' and estado=1 and idregistro=$idregistro and tipo=$tipo  order by registro desc  ";


    $SQl .="  limit $offset, $limin";
//echo $SQl;

    $query = $this->db->query($SQl);

    return $query;
}
function mostrarapp($nombre, $idregistro, $tipo, $offset, $limin) {


    $SQl = "SELECT descripcion,IFNULL(urlDropbox,1) as urlDropbox , url FROM archivos where descripcion like '%$nombre%' and estado=1 and idregistro=$idregistro and tipo=$tipo  order by registro desc  ";


    $SQl .="  limit $offset, $limin";
//echo $SQl;

    $query = $this->db->query($SQl);

    return $query;
}

function Buscar($id) {

    $this->db->where('idarchivos', $id);
    $query = $this->db->get('archivos');
    return $query;
}

function limpiar($string) {
    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string
        );
    return $string;
}

function countArchivos($idregistro) {

   $SQl = "Select 
   count(*) as num, tipo
   from
   archivos
   where
   idregistro = $idregistro and estado=1 group by tipo;";

   $query = $this->db->query($SQl);

   return $query;

}

}