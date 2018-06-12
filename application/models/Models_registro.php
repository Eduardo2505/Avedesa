<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_registro extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('registro', $data);
        $id = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $id;
        }
    }

    function update($id, $data) {

        $this->db->trans_begin();
        $this->db->where('idregistro', $id);
        $this->db->update('registro', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();

            return 1;
        }
    }

    function getExcel($SQl) {
        $fields = $this->db->field_data('registro');
        $query = $this->db->query($SQl);
        return array("fields" => $fields, "query" => $query);
    }

    function get() {

        return $query = $this->db->get('registro');
    }

    function getEliminarfecha($atributo) {
              $this->db->where($atributo, '0000-00-00');
        return $query = $this->db->get('registro');
    }

    function filtro($filtro) {
        $SQl = "SELECT 
    *
        FROM
        registro
        where
        concat(idregistro, ' ', num_expediente) 
        like '%$filtro%' limit 0,300";
        $query = $this->db->query($SQl);

        return $query;
    }

    function mostrar($estado_fecha, $numava, $fecha_de_entrega_inicial, $fecha_de_entrega_finali, $numExpediente, $folio, $nomRefer, $telefono, $email, $tipo_avaluo, $objetivoAvaluo, $otros, $ubicacion, $costo, $fecha_de_inspeccion_inicial, $fecha_de_inspeccion_final, $hora_de_inspeccion, $idempleado, $monto_credito, $monto_venta, $intermediario, $idcapturista, $observaciones, $estado_registro, $fecha_asigancion_inicia, $fecha_asigancion_finali, $fecha_captura_inicial, $fecha_captura_finali, $fecha_cierre_inicial, $fecha_cierre_finali, $registro_inicial_inicial, $registro_inicial_finali, $offset, $limin) {

        $SQl = "SELECT 
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
        from
        registro r,
        tipo_avaluo ta,
        objetivo_avaluo oa,
        empleado e,
        estado_registro er
        where
        r.idtipo_avaluo = ta.idtipo_avaluo
        and r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        and er.idestado_registro=r.idestado_registro
        and e.idempleado = r.idempleado";
        if ($folio != "") {
            $SQl .=" and r.idregistro=$folio";
        }
        $SQl .=" and r.referencia like '%$nomRefer%'
        and r.telefono like '%$telefono%'
        and  r.estado_fecha like '%$estado_fecha%'
        and r.email like '%$email%'
        and ta.nombre like '%$tipo_avaluo%'
        and oa.nombre like '%$objetivoAvaluo%'
        and r.otros like '%$otros%'
        and r.ubicacion like '%$ubicacion%'
        and r.num_avaluo like '%$numava%'
        and r.num_expediente like '%$numExpediente%'
        and r.costo like '%$costo%'
        and er.estado like '%$estado_registro%' ";
        if ($hora_de_inspeccion != "") {
          
           $SQl .=" and r.hora_de_inspeccion like '%$hora_de_inspeccion%' ";
        }

        if ($idempleado != "") {
            $SQl .="and e.idempleado=$idempleado ";
        }
        $SQl .=" and r.monto_credito like '%$monto_credito%'
        and r.monto_venta like '%$monto_venta%'
        and r.observaciones like '%$observaciones%'";

        if ($fecha_de_inspeccion_inicial != "" && $fecha_de_inspeccion_final != "") {
            $SQl .=" and r.fecha_de_inspeccion BETWEEN '$fecha_de_inspeccion_inicial' and '$fecha_de_inspeccion_final'";
        }

        if ($fecha_de_entrega_inicial != "" && $fecha_de_entrega_finali != "") {
            $SQl .=" and r.fecha_de_entrega BETWEEN '$fecha_de_entrega_inicial' and '$fecha_de_entrega_finali'";
        }
        if ($fecha_asigancion_inicia != "" && $fecha_asigancion_finali != "") {
            $SQl .=" and r.fecha_asigancion BETWEEN '$fecha_asigancion_inicia' and '$fecha_asigancion_finali'";
        }

        if ($fecha_captura_inicial != "" && $fecha_captura_finali != "") {
            $SQl .=" and r.fecha_captura BETWEEN '$fecha_captura_inicial' and '$fecha_captura_finali'";
        }
        if ($fecha_cierre_inicial != "" && $fecha_cierre_finali != "") {
            $SQl .=" and r.fecha_cierre BETWEEN '$fecha_cierre_inicial' and '$fecha_cierre_finali'";
        }
        if ($registro_inicial_inicial != "" && $registro_inicial_finali != "") {
            $SQl .=" and r.registro_inicial BETWEEN '$registro_inicial_inicial' and '$registro_inicial_finali'";
        }

        $SQl .=" and r.intermediario like '%$intermediario%' ";

        if ($idcapturista != "") {
            $SQl .=" and r.idcapturista=$idcapturista";
        }

        $SQl .=" order by r.idregistro desc limit $offset, $limin";


     

        $query = $this->db->query($SQl);

        return $query;
    }

    function mostrarcount($estado_fecha, $numava, $fecha_de_entrega_inicial, $fecha_de_entrega_finali, $numExpediente, $folio, $nomRefer, $telefono, $email, $tipo_avaluo, $objetivoAvaluo, $otros, $ubicacion, $costo, $fecha_de_inspeccion_inicial, $fecha_de_inspeccion_final, $hora_de_inspeccion, $idempleado, $monto_credito, $monto_venta, $intermediario, $idcapturista, $observaciones, $estado_registro, $fecha_asigancion_inicia, $fecha_asigancion_finali, $fecha_captura_inicial, $fecha_captura_finali, $fecha_cierre_inicial, $fecha_cierre_finali, $registro_inicial_inicial, $registro_inicial_finali) {
        $SQl = "SELECT 
        r.idregistro
        from
        registro r,
        tipo_avaluo ta,
        objetivo_avaluo oa,
        empleado e,
        estado_registro er
        where
        r.idtipo_avaluo = ta.idtipo_avaluo
        and r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        and er.idestado_registro=r.idestado_registro
        and e.idempleado = r.idempleado";
        if ($folio != "") {
            $SQl .=" and r.idregistro=$folio";
        }
        $SQl .=" and r.referencia like '%$nomRefer%'
        and r.telefono like '%$telefono%'
        and  r.estado_fecha like '%$estado_fecha%'
        and r.email like '%$email%'
        and r.num_avaluo like '%$numava%'
        and ta.nombre like '%$tipo_avaluo%'
        and oa.nombre like '%$objetivoAvaluo%'
        and r.otros like '%$otros%'
        and r.num_expediente like '%$numExpediente%'
        and r.ubicacion like '%$ubicacion%'
        and r.costo like '%$costo%'
        and er.estado like '%$estado_registro%'";
        if ($hora_de_inspeccion != "") {

          $SQl .=" and r.hora_de_inspeccion like '%$hora_de_inspeccion%' ";
        }
        if ($idempleado != "") {
            $SQl .="and e.idempleado=$idempleado ";
        }
        $SQl .=" and r.monto_credito like '%$monto_credito%'
        and r.monto_venta like '%$monto_venta%'
        and r.observaciones like '%$observaciones%'";


        if ($fecha_de_inspeccion_inicial != "" && $fecha_de_inspeccion_final != "") {
            $SQl .=" and r.fecha_de_inspeccion BETWEEN '$fecha_de_inspeccion_inicial' and '$fecha_de_inspeccion_final'";
        }
        if ($fecha_de_entrega_inicial != "" && $fecha_de_entrega_finali != "") {
            $SQl .=" and r.fecha_de_entrega BETWEEN '$fecha_de_entrega_inicial' and '$fecha_de_entrega_finali'";
        }
        if ($fecha_asigancion_inicia != "" && $fecha_asigancion_finali != "") {
            $SQl .=" and r.fecha_asigancion BETWEEN '$fecha_asigancion_inicia' and '$fecha_asigancion_finali'";
        }

        if ($fecha_captura_inicial != "" && $fecha_captura_finali != "") {
            $SQl .=" and r.fecha_captura BETWEEN '$fecha_captura_inicial' and '$fecha_captura_finali'";
        }
        if ($fecha_cierre_inicial != "" && $fecha_cierre_finali != "") {
            $SQl .=" and r.fecha_cierre BETWEEN '$fecha_cierre_inicial' and '$fecha_cierre_finali'";
        }
        if ($registro_inicial_inicial != "" && $registro_inicial_finali != "") {
            $SQl .=" and r.registro_inicial BETWEEN '$registro_inicial_inicial' and '$registro_inicial_finali'";
        }

        $SQl .=" and r.intermediario like '%$intermediario%' ";

        if ($idcapturista != "") {
            $SQl .=" and r.idcapturista=$idcapturista";
        }

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrarcountString($numava, $fecha_de_entrega_inicial, $fecha_de_entrega_finali, $numExpediente, $folio, $nomRefer, $telefono, $email, $tipo_avaluo, $objetivoAvaluo, $otros, $ubicacion, $costo, $fecha_de_inspeccion_inicial, $fecha_de_inspeccion_final, $hora_de_inspeccion, $idempleado, $monto_credito, $monto_venta, $intermediario, $idcapturista, $observaciones, $estado_registro, $fecha_asigancion_inicia, $fecha_asigancion_finali, $fecha_captura_inicial, $fecha_captura_finali, $fecha_cierre_inicial, $fecha_cierre_finali, $registro_inicial_inicial, $registro_inicial_finali) {
        $SQl = "SELECT 
        r.idregistro AS ID,
        r.num_expediente,
        r.referencia AS Referencia,
        ta.nombre AS Tipo,
        r.ubicacion AS Ubicacion, 
        r.costo AS Costo,   
        CONCAT(e.Nombre, ' ', e.apellidos) AS inspector,
        r.telefono AS Telefono,
        r.email AS Email,    
        oa.nombre AS Objetivo,
        r.otros AS Otros,  
        r.fecha_de_inspeccion AS Fecha_Inspeccion,
        r.hora_de_inspeccion AS Hora_Inspeccion,    
        r.monto_credito,
        r.monto_venta,
        e.color,
        r.tipoRegistro,
        r.intermediario nomIntermediria,
        (SELECT 
        CONCAT(Nombre, ' ', apellidos)
        FROM
        empleado
        WHERE
        idempleado = r.idcapturista) AS capturista,
        (SELECT 
        CONCAT(Nombre, ' ', apellidos)
        FROM
        empleado
        WHERE
        idempleado = r.id_asigno) AS asigno,
        r.fecha_de_entrega,
        r.usuario_entrega,
        r.observaciones,
        r.fecha_asigancion,
        r.fecha_captura,
        r.fecha_cierre,
        r.fecha_final,
        r.adelanto_pago,
        r.num_avaluo
        from
        registro r,
        tipo_avaluo ta,
        objetivo_avaluo oa,
        empleado e,
        estado_registro er
        where
        r.idtipo_avaluo = ta.idtipo_avaluo
        and r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        and er.idestado_registro=r.idestado_registro
        and e.idempleado = r.idempleado ";
        if ($folio != "") {
            $SQl .=" and r.idregistro=$folio";
        }
        $SQl .=" and r.referencia like '%$nomRefer%'
        and r.telefono like '%$telefono%'
        and r.email like '%$email%'
        and r.num_avaluo like '%$numava%'
        and ta.nombre like '%$tipo_avaluo%'
        and oa.nombre like '%$objetivoAvaluo%'
        and r.otros like '%$otros%'
        and r.ubicacion like '%$ubicacion%'
        and er.estado like '%$estado_registro%'
        and r.num_expediente like '%$numExpediente%'
        and r.costo like '%$costo%'
        and r.hora_de_inspeccion like '%$hora_de_inspeccion%' ";
        if ($idempleado != "") {
            $SQl .="and e.idempleado=$idempleado ";
        }
        $SQl .=" and r.monto_credito like '%$monto_credito%'
        and r.monto_venta like '%$monto_venta%'
        and r.observaciones like '%$observaciones%'";

        if ($fecha_de_inspeccion_inicial != "" && $fecha_de_inspeccion_final != "") {
            $SQl .=" and r.fecha_de_inspeccion BETWEEN '$fecha_de_inspeccion_inicial' and '$fecha_de_inspeccion_final'";
        }

        if ($fecha_de_entrega_inicial != "" && $fecha_de_entrega_finali != "") {
            $SQl .=" and r.fecha_de_entrega BETWEEN '$fecha_de_entrega_inicial' and '$fecha_de_entrega_finali'";
        }

        if ($fecha_asigancion_inicia != "" && $fecha_asigancion_finali != "") {
            $SQl .=" and r.fecha_asigancion BETWEEN '$fecha_asigancion_inicia' and '$fecha_asigancion_finali'";
        }


        if ($fecha_captura_inicial != "" && $fecha_captura_finali != "") {
            $SQl .=" and r.fecha_captura BETWEEN '$fecha_captura_inicial' and '$fecha_captura_finali'";
        }
        if ($fecha_cierre_inicial != "" && $fecha_cierre_finali != "") {
            $SQl .=" and r.fecha_cierre BETWEEN '$fecha_cierre_inicial' and '$fecha_cierre_finali'";
        }
        if ($registro_inicial_inicial != "" && $registro_inicial_finali != "") {
            $SQl .=" and r.registro_inicial BETWEEN '$registro_inicial_inicial' and '$registro_inicial_finali'";
        }




        $SQl .=" and r.intermediario like '%$intermediario%' ";

        if ($idcapturista != "") {
            $SQl .=" and r.idcapturista=$idcapturista";
        }
        $SQl .=" order by r.idregistro desc";
        // echo $SQl;

        return $SQl;
    }

    function buscarObj($idregistro) {

        $this->db->where('idregistro', $idregistro);
        $query = $this->db->get('registro');
        $row = $query->row();
        return $row;


    }

    function buscar($idregistro) {
        $sQl = "SELECT 
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
        e.idempleado,
        r.monto_credito,
        r.monto_venta,
        r.observaciones,
        r.fecha_asigancion,
        r.fecha_captura,
        r.fecha_cierre,
        r.fecha_final,
        r.registro_inicial,
        r.registro,
        e.color,
        r.intermediario nomIntermediria,
        r.num_expediente,
        r.adelanto_pago,
        r.id_asigno,
        r.num_avaluo,
        r.tipoRegistro,
        r.recomienda,
        r.idestado_registro,
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
        idempleado = r.id_asigno) as asigno,
        ta.idtipo_avaluo,
        oa.idobjetivo_avaluo,
        r.idcapturista,
        r.fecha_de_entrega,
        r.usuario_entrega
        from
        registro r,
        tipo_avaluo ta,
        objetivo_avaluo oa,
        empleado e,
        estado_registro er
        where
        r.idtipo_avaluo = ta.idtipo_avaluo
        and er.idestado_registro=r.idestado_registro
        and r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        and e.idempleado = r.idempleado
        and r.idregistro = $idregistro";


        $query = $this->db->query($sQl);

        return $query;
    }

    function Horafecha() {

        $SQl = "select now() as hora ";
        $query = $this->db->query($SQl);
        $row = $query->row();

        return $row->hora;
    }

    function fecha() {

        $SQl = "select CURDATE() as fecha ";
        $query = $this->db->query($SQl);
        $row = $query->row();

        return $row->fecha;
    }

    function obtenerFechaEnLetra($fecha) {
        $this->load->model('models_registro');
        $dia = $this->models_registro->conocerDiaSemanaFecha($fecha);
        $num = date("j", strtotime($fecha));
        $anno = date("Y", strtotime($fecha));
        $mes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
        return $dia . ', ' . $num . ' de ' . $mes . ' del ' . $anno;
    }

    function conocerDiaSemanaFecha($fecha) {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $dia = $dias[date('w', strtotime($fecha))];
        return $dia;
    }
    
    function countFolio($fecha,$idempleado) {


       $SQl="SELECT 
              max(num_folio) maxfolio
       FROM
       registro
       WHERE
       fecha_de_inspeccion = '".$fecha."'
       AND idempleado = $idempleado";

       $query = $this->db->query($SQl);
       $row = $query->row();

       return $row->maxfolio;
   }

   function verificarDias($idregistro,$idestado_registro) {


       $SQl="SELECT 
       registro,estado
       FROM
       estado_empleado
       where
       idregistro = $idregistro
        and idestado_registro = $idestado_registro";//and estado=1
        
        $query = $this->db->query($SQl);

        
        return $query;;




    }


    function fechaCierreUpdate() {

        $SQl = "select DATE_ADD(CURDATE(), INTERVAL 2 DAY) as fecha ";
        $query = $this->db->query($SQl);
        $row = $query->row();

        return $row->fecha;
    }

    function calendario($fecha,$estado,$tipo) {

      list($dia, $mes, $ano) = explode('/', $fecha);
      $mesanicial=$ano."-".$mes.'-'.$dia;
      if($tipo=='month'){
          $nuevaFecha = date('Y-m-d', strtotime($mesanicial .'+1 month'));
      }else if($tipo=='agendaWeek'){
          $nuevaFecha = date('Y-m-d', strtotime($mesanicial .'+1 weeks'));
     }else{
         $nuevaFecha = date('Y-m-d', strtotime($mesanicial .'+1 day'));
     }

      $SQl="SELECT 
      r.fecha_de_inspeccion,
      r.hora_de_inspeccion,
      r.idregistro,
      r.num_expediente,
      concat(e.Nombre, ' ', e.apellidos) as inspector,
      er.idestado_registro,
      e.color
      FROM
      registro r
      INNER JOIN
      estado_empleado er ON r.idregistro = er.idregistro
      INNER JOIN
      empleado e ON e.idempleado = er.idempleado
      where
      r.fecha_de_inspeccion between '$mesanicial' and '$nuevaFecha'
      and r.fecha_de_inspeccion != '$nuevaFecha'
      and er.idestado_registro in($estado)
      UNION
      SELECT 
      r.fecha_de_inspeccion,
      r.hora_de_inspeccion,
      r.idregistro,
      r.num_expediente,
      'S/A' as inspector,
      -1 as idestado_registro,
      '#FA0000' as color
      FROM
      registro r
      where
      r.fecha_de_inspeccion between '$mesanicial' and '$nuevaFecha'
      and r.fecha_de_inspeccion != '$nuevaFecha'
      and r.idregistro NOT IN (SELECT 
      r.idregistro
      FROM
      registro r
      INNER JOIN
      estado_empleado er ON r.idregistro = er.idregistro
      where
      r.fecha_de_inspeccion between '$mesanicial' and '$nuevaFecha'
      and r.fecha_de_inspeccion != '$nuevaFecha'
      and er.idestado_registro in($estado))";




      $query = $this->db->query($SQl);

      return $query;
  }


   function infoPagos($idregistro) {

        $SQl = "SELECT 
    (SELECT 
            costo
        FROM
            registro
        WHERE
            idregistro = $idregistro) costo,
    (SELECT 
            IFNULL(SUM(anticipo), 0) pagos
        FROM
            pagos
        WHERE
            idregistro = $idregistro AND estado != 0) pagos,
    (SELECT 
            IFNULL(SUM(p.anticipo), 0) pagodos
        FROM
            pagosaceptados a,
            pagos p
        WHERE
            a.idpagos = p.idpagos
                AND p.idregistro = $idregistro
                AND estado != 0) pagados";
      // echo  $SQl;
        $query = $this->db->query($SQl);

        return $query;
    }


   

    function buscarObjv2($idregistro) {

         $SQl="SELECT 
    r.fecha_de_entrega,
    r.registro,
    r.num_expediente,
    (SELECT 
            clave_gys
        FROM
            empleado
        WHERE
            idempleado = r.idOperador) AS idOperador,            
            (SELECT 
            clave_gys
        FROM
            empleado
        WHERE
            idempleado = r.idempleado) AS ClaveVisitador,
                        (SELECT 
            clave_gys
        FROM
            empleado
        WHERE
            idempleado = r.id_asigno) AS ClaveEjecutivo,
            (SELECT 
            id_gys
        FROM
            objetivo_avaluo
        WHERE
            idobjetivo_avaluo = r.idobjetivo_avaluo) ClaveProducto,
             (SELECT 
            id_gys
        FROM
            tipo_avaluo
        WHERE
            idtipo_avaluo = r.idtipo_avaluo) ClavePropositoAvaluo,
            clave,
            reporteTesoreria
FROM
    registro r where idregistro=$idregistro";


        $query = $this->db->query($SQl);
        $row = $query->row();
        return $row;
    }

}