<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-06-11 17:04:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregi' at line 56 - Invalid query: SELECT DISTINCT
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
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregistro desc limit 0, 10
ERROR - 2018-06-11 17:04:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=' at line 11 - Invalid query: SELECT DISTINCT  
        r.idregistro
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=
ERROR - 2018-06-11 17:04:41 --> Severity: Error --> Call to a member function num_rows() on boolean C:\wamp\www\Ave\application\models\Models_registro_consulta.php 166
ERROR - 2018-06-11 17:04:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregi' at line 56 - Invalid query: SELECT DISTINCT
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
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregistro desc limit 0, 10
ERROR - 2018-06-11 17:04:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=' at line 11 - Invalid query: SELECT DISTINCT  
        r.idregistro
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=
ERROR - 2018-06-11 17:04:50 --> Severity: Error --> Call to a member function num_rows() on boolean C:\wamp\www\Ave\application\models\Models_registro_consulta.php 166
ERROR - 2018-06-11 17:05:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregi' at line 56 - Invalid query: SELECT DISTINCT
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
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregistro desc limit 0, 10
ERROR - 2018-06-11 17:05:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=' at line 11 - Invalid query: SELECT DISTINCT  
        r.idregistro
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=
ERROR - 2018-06-11 17:05:10 --> Severity: Error --> Call to a member function num_rows() on boolean C:\wamp\www\Ave\application\models\Models_registro_consulta.php 166
ERROR - 2018-06-11 17:05:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregi' at line 56 - Invalid query: SELECT DISTINCT
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
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregistro desc limit 0, 10
ERROR - 2018-06-11 17:05:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=' at line 11 - Invalid query: SELECT DISTINCT  
        r.idregistro
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=
ERROR - 2018-06-11 17:05:13 --> Severity: Error --> Call to a member function num_rows() on boolean C:\wamp\www\Ave\application\models\Models_registro_consulta.php 166
ERROR - 2018-06-11 17:17:27 --> Severity: Parsing Error --> syntax error, unexpected ''id'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' C:\wamp\www\Ave\application\controllers\Salir.php 23
ERROR - 2018-06-11 17:17:43 --> Severity: Notice --> Undefined variable: filtro C:\wamp\www\Ave\application\controllers\Salir.php 35
ERROR - 2018-06-11 17:17:43 --> Severity: Notice --> Trying to get property of non-object C:\wamp\www\Ave\application\controllers\Salir.php 35
ERROR - 2018-06-11 17:18:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregi' at line 56 - Invalid query: SELECT DISTINCT
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
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregistro desc limit 0, 10
ERROR - 2018-06-11 17:18:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=' at line 11 - Invalid query: SELECT DISTINCT  
        r.idregistro
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=
ERROR - 2018-06-11 17:18:32 --> Severity: Error --> Call to a member function num_rows() on boolean C:\wamp\www\Ave\application\models\Models_registro_consulta.php 166
ERROR - 2018-06-11 17:18:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregi' at line 56 - Invalid query: SELECT DISTINCT
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
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregistro desc limit 0, 10
ERROR - 2018-06-11 17:18:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=' at line 11 - Invalid query: SELECT DISTINCT  
        r.idregistro
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=
ERROR - 2018-06-11 17:18:50 --> Severity: Error --> Call to a member function num_rows() on boolean C:\wamp\www\Ave\application\models\Models_registro_consulta.php 166
ERROR - 2018-06-11 17:21:04 --> 404 Page Not Found: Solicitudes/buscar
ERROR - 2018-06-11 17:21:04 --> 404 Page Not Found: Solicitudes/favicon.ico
ERROR - 2018-06-11 17:23:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregi' at line 56 - Invalid query: SELECT DISTINCT
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
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio= order by r.idregistro desc limit 10, 10
ERROR - 2018-06-11 17:23:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=' at line 11 - Invalid query: SELECT DISTINCT  
        r.idregistro
        from registro r
        INNER JOIN tipo_avaluo ta ON r.idtipo_avaluo = ta.idtipo_avaluo
        INNER JOIN objetivo_avaluo oa ON r.idobjetivo_avaluo = oa.idobjetivo_avaluo
        INNER JOIN empleado e ON e.idempleado = r.idempleado
        INNER JOIN estado_registro er ON er.idestado_registro=r.idestado_registro
        LEFT JOIN visita v ON v.idregistro=r.idregistro
        LEFT JOIN solicitante s ON s.idregistro=r.idregistro
        LEFT JOIN inmueble i ON i.idregistro=r.idregistro
        where r.num_expediente like '%%'  and r.tipoSnc= and v.VisitaExitosa= and i.ClaveEntidad= and i.ClaveMunicipio=
ERROR - 2018-06-11 17:23:42 --> Severity: Error --> Call to a member function num_rows() on boolean C:\wamp\www\Ave\application\models\Models_registro_consulta.php 166
ERROR - 2018-06-11 17:51:19 --> Severity: Parsing Error --> syntax error, unexpected ',' C:\wamp\www\Ave\application\controllers\SolicitudesConsulta.php 256
ERROR - 2018-06-11 17:51:20 --> Severity: Parsing Error --> syntax error, unexpected ',' C:\wamp\www\Ave\application\controllers\SolicitudesConsulta.php 256
ERROR - 2018-06-11 20:18:25 --> Severity: Notice --> Undefined property: stdClass::$col_i C:\wamp\www\Ave\application\models\Models_registro_consulta.php 327
ERROR - 2018-06-11 20:18:25 --> Severity: Notice --> Undefined property: stdClass::$col_i C:\wamp\www\Ave\application\models\Models_registro_consulta.php 327
ERROR - 2018-06-11 20:18:34 --> Severity: Notice --> Undefined property: stdClass::$col_i C:\wamp\www\Ave\application\models\Models_registro_consulta.php 327
ERROR - 2018-06-11 20:18:34 --> Severity: Notice --> Undefined property: stdClass::$col_i C:\wamp\www\Ave\application\models\Models_registro_consulta.php 327
ERROR - 2018-06-11 20:19:25 --> Severity: Notice --> Undefined property: stdClass::$col_i C:\wamp\www\Ave\application\models\Models_registro_consulta.php 327
ERROR - 2018-06-11 20:19:25 --> Severity: Notice --> Undefined property: stdClass::$col_i C:\wamp\www\Ave\application\models\Models_registro_consulta.php 327
ERROR - 2018-06-11 20:42:34 --> Severity: Parsing Error --> syntax error, unexpected '.' C:\wamp\www\Ave\application\controllers\SolicitudesConsulta.php 303
ERROR - 2018-06-11 20:42:42 --> Severity: Parsing Error --> syntax error, unexpected '.' C:\wamp\www\Ave\application\controllers\SolicitudesConsulta.php 303
ERROR - 2018-06-11 20:42:44 --> Severity: Parsing Error --> syntax error, unexpected '.' C:\wamp\www\Ave\application\controllers\SolicitudesConsulta.php 303
ERROR - 2018-06-11 20:49:07 --> Severity: Notice --> Undefined property: stdClass::$lt_i C:\wamp\www\Ave\application\models\Models_registro_consulta.php 358
ERROR - 2018-06-11 20:49:07 --> Severity: Notice --> Undefined property: stdClass::$lt_i C:\wamp\www\Ave\application\models\Models_registro_consulta.php 358
