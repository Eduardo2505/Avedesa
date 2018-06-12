<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_empleado extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('models_asig_puesto');
    }

    function insertar($data, $numero) {
        $this->db->trans_begin();
        $this->db->insert('empleado', $data);
        $count = count($numero);
        $idEmpleado = $this->db->insert_id();

        for ($i = 0; $i < $count; $i++) {
            $data1 = array(
                'idempleado' => $idEmpleado,
                'idcat_puesto' => $numero[$i]);

            $this->models_asig_puesto->insertar($data1);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function updatepass($id, $data) {


        $this->db->trans_begin();
        $this->db->where('idempleado', $id);
        $this->db->update('empleado', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function update($id, $data, $numero) {

        $this->db->trans_begin();
        $this->db->where('idempleado', $id);
        $this->db->update('empleado', $data);
        $count = count($numero);

        $this->models_asig_puesto->eliminar($id);

        for ($i = 0; $i < $count; $i++) {
            $data1 = array(
                'idempleado' => $id,
                'idcat_puesto' => $numero[$i]);
            //echo $numero[$i];
            $this->models_asig_puesto->insertar($data1);
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function getInspector() {


        $SQl = "select 
        e . *
        from
        empleado e,
        asig_puesto ap
        where
        e.idEmpleado = ap.idEmpleado
        and ap.idcat_puesto = 2 and e.estado=1";
        $query = $this->db->query($SQl);

        return $query;
    }
    function getInspectorActivos() {


        $SQl = "select 
        e . *
        from
        empleado e,
        asig_puesto ap
        where
        e.idEmpleado = ap.idEmpleado
        and ap.idcat_puesto = 2 and e.estado=1 and e.clave_gys is not null";
        $query = $this->db->query($SQl);

        return $query;
    }
    function getOperador() {

        $SQl = "select *
        from
        empleado 
        where perfil like '%OPERADOR INTERNO%'";
        $query = $this->db->query($SQl);

        return $query;
    }
     function getAsignadorActivos() {
      $SQl = "select 
      e . *
      from
      empleado e,
      asig_puesto ap
      where
      e.idEmpleado = ap.idEmpleado
      and ap.idcat_puesto = 7 and e.estado=1 and e.clave_gys is not null";
      $query = $this->db->query($SQl);
      return $query;
  }

    function getAsignador() {
      $SQl = "select 
      e . *
      from
      empleado e,
      asig_puesto ap
      where
      e.idEmpleado = ap.idEmpleado
      and ap.idcat_puesto = 7 and e.estado=1";
      $query = $this->db->query($SQl);
      return $query;
  }

  function login($email, $password) {
    $sql = "SELECT 
    p.*,e.*
    FROM
    asig_puesto asig,
    cat_puesto p,
    empleado e
    WHERE
    e.idempleado = asig.idempleado
    AND p.idcat_puesto = asig.idcat_puesto
    AND e.estado = 1
    AND e.email = '$email'
    AND e.pass = '$password'";


    $query = $this->db->query($sql);
    return $query;
}

function capturista() {
    $sql = "SELECT 
    p.*,e.*
    FROM
    asig_puesto asig,
    cat_puesto p,
    empleado e
    WHERE
    e.idempleado = asig.idempleado
    AND p.idcat_puesto = asig.idcat_puesto
    AND e.estado = 1
    AND (p.idcat_puesto = 1 OR p.idcat_puesto = 6) group by e.idempleado,p.idcat_puesto";



    $query = $this->db->query($sql);
    return $query;
}

function mostrarcount($nombre,$estado) {

    $SQl = "SELECT e.*,em.nombre FROM empleado e, empresa em where e.idempresa=em.idempresa and concat(e.Nombre,' ',e.apellidos) like '%$nombre%' and idempleado!=0 and $estado";

    $query = $this->db->query($SQl);

    return $query->num_rows();
}

function mostrar($nombre,$estado, $offset, $limin) {

    $SQl = "SELECT e.*,em.nombre as empresa FROM empleado e, empresa em where e.idempresa=em.idempresa and concat(e.Nombre,' ',e.apellidos) like '%$nombre%' and idempleado!=0 and $estado order by e.Nombre asc ";


    $SQl .="  limit $offset, $limin";


    $query = $this->db->query($SQl);

    return $query;
}

function Buscar($id) {

    $this->db->where('idempleado', $id);
    $query = $this->db->get('empleado');
    return $query;
}

function puestoEmpleados($idPuesto) {

    $SQl = "SELECT 
    cp.puesto,cp.idcat_puesto
    FROM
    cat_puesto cp,
    asig_puesto ap
    where
    cp.idcat_puesto = ap.idcat_puesto
    and ap.idempleado = $idPuesto";



    $query = $this->db->query($SQl);

    return $query;
}

function get() {
    $this->db->order_by("Nombre", "asc");
    $this->db->order_by("apellidos", "asc");
    $this->db->where('estado', 1);
    return $query = $this->db->get('empleado');
}

}