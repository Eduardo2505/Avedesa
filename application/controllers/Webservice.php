<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webservice extends CI_Controller {


    function __construct() {

        parent::__construct();

        $this->load->model('models_webservice');
        
    }

    public function conectar() {

    $inmueble =(object) array("ClaveTipoInmueble" => 1, 
    	              "CodigoPostal" => '14400', 
    	              "ClaveEntidad" => 9,
    	              "ClaveMunicipio" => 2,
    	              "Colonia" => "San Andres",
    	              "Calle" => "Palma",
    	              "NumeroExterior" => "Mz2",
    	              "NumeroInterior" => "Lt2",
    	              "SuperManzana" => "SuperMz",
    	              "Manzana" => "Manzana2",
    	              "Lote" => "lote2",
    	              "Condominio" => "condominiob",
    	              "Entrada" => "entradab",
    	              "Edificio" => "edificio b",
    	              "Departamento" => "Depto2",
    	              "EntreCalle" => "entrecalle2",
    	              "YCalle" => "ycalle",
    	              "Ciudad" => "CiudadPa",
    	              "Latitud" => 21.8818,
    	              "Longitud" => -102.291,
    	              "Altitud" => 1.888);


       $solicitante = (object) array("Nombre" => "Eduardo",
									    "ApellidoPaterno" => "Padilla",
										"ApellidoMaterno" => "Cruz",
										"PersonaMoral" => true,
										"Rfc" => "RFC",
										"Nss" => "NSS",
										"CodigoPostal" => "14400",
										"ClaveEntidad" => 6,
										"ClaveMunicipio" => 2,
										"Colonia" => "Colinia",
										"Calle" => "callepalm",
										"NumeroExterior" => "numExtery010",
										"NumeroInterior" => "numInter25",
										"Telefono" => "55555555",
										"CorreoElectronico" => "eduardo@hsasas.com");


    $dateV = date("c", strtotime('11/12/2018'));

		 $visita = (object) array("FechaVisita" => $dateV,
									    "VisitaExitosa" => true,
										"ContactoVisita" => "Jose contacto",
										"Telefono" => "5555038625");

		$date = date("c", strtotime('11/12/2018'));


  		$configuracion = (object) array("FechaCompromisoEntrega" => $date,
									    "FechaSolicitado" => $date,
										 "FolioCliente" => "2010431168FD",
										 "ClaveOperador" => 694,
										 "ClaveVisitador" => 694,
										 "ClaveEjecutivo" => 694,
										 "ClaveProducto" => 2173, // tabla ADMIN objetivo_avaluo
									   "ClavePropositoAvaluo" => 2,  // tabla ADMIN tipo_avaluo
									   "ReportaTesoreriaCDMX" => true,
                     "ClaveSociedadTesoreria" => 2,
									   "ClaveIntermediarioFinanciero" => "030002");
  	
      
     $respuesta=$this->models_webservice->conectar($inmueble,$solicitante,$visita,$configuracion);

     echo $respuesta->Exito."<br>";
     echo $respuesta->Mensaje;


   }







}
