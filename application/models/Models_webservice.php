<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
// objeto 

class Visita
{


	function Visita($fechaVisita,$visitaExitosa,$contactoVisita,$telefono)
	{

		$this->FechaVisita = $fechaVisita;
		$this->VisitaExitosa = $visitaExitosa;
		$this->ContactoVisita = $contactoVisita;
		$this->Telefono = $telefono;
	}
}

class Solicitante
{


	function Solicitante($nombre,
		$apellidoPaterno,
		$apellidoMaterno,
		$personaMoral,
		$rfc,
		$nss,
		$codigoPostal,
		$claveEntidad,
		$claveMunicipio,
		$colonia,
		$calle,
		$numeroExterior,
		$numeroInterior,
		$telefono,
		$correoElectronico
	)
	{

		$this->Nombre = $nombre;
		$this->ApellidoPaterno = $apellidoPaterno;
		$this->ApellidoMaterno = $apellidoMaterno;
		$this->PersonaMoral = $personaMoral;
		$this->Rfc = $rfc;
		$this->Nss = $nss;
		$this->CodigoPostal = $codigoPostal;
		$this->ClaveEntidad = $claveEntidad;
		$this->ClaveMunicipio = $claveMunicipio;
		$this->Colonia = $colonia;
		$this->Calle = $calle;
		$this->NumeroExterior = $numeroExterior;
		$this->Telefono = $telefono;
		$this->CorreoElectronico = $correoElectronico;
	}
}

class Inmueble
{


	function Inmueble($claveTipoInmueble,
		$codigoPostal,
		$claveEntidad,
		$claveMunicipio,
		$colonia,
		$calle,
		$numeroExterior,
		$numeroInterior,
		$superManzana,
                          $manzana,//10
                          $lote,
                          $condominio,
                          $entrada,
                          $edificio,//10
                          $departamento,
                          $entreCalle,
                          $yCalle,
                          $ciudad,
                          $latitud,
                          $longitud,
                          $altitud)
	{

		$this->ClaveTipoInmueble = $claveTipoInmueble;
		$this->CodigoPostal = $codigoPostal;
		$this->ClaveEntidad = $claveEntidad;
		$this->ClaveMunicipio = $claveMunicipio;
		$this->Colonia = $colonia;
		$this->Calle = $calle;
		$this->NumeroExterior = $numeroExterior;
		$this->NumeroInterior = $numeroInterior;
		$this->SuperManzana = $superManzana;
          $this->Manzana = $manzana;//10
          $this->Lote = $lote;
          $this->Condominio = $condominio;
          $this->Entrada = $entrada;
          $this->Edificio = $edificio;
          $this->Departamento = $departamento;
          $this->EntreCalle = $entreCalle;
          $this->YCalle = $yCalle;
          $this->Ciudad = $ciudad;
          $this->Latitud = $latitud;
          $this->Longitud = $longitud;//20
          $this->Altitud = $altitud;
        }
      }



      class Archivo
      {


       function Archivo($base64File,
        $nombre)
       {

        $this->Base64File = $base64File;
        $this->Nombre = $nombre;
      }
    }

    class SolicitudIndividual
    {


     function SolicitudIndividual($token,
      $configuracion,
      $inmueble,
      $solicitante,
      $visita,
      $observaciones,
      $archivos)
     {

      $this->Token = $token;
      $this->Configuracion = $configuracion;
      $this->Inmueble = $inmueble;
      $this->Solicitante = $solicitante;
      $this->Visita = $visita;
      $this->Observaciones = $observaciones;          
      $this->Archivos = $archivos;
    }
  }

  class Configuracion
  {


  	function Configuracion($fechaCompromisoEntrega,
  		$fechaSolicitado,
  		$folioCliente,
  		$claveOperador,
  		$claveVisitador,
  		$claveEjecutivo,
  		$claveProducto,
  		$clavePropositoAvaluo,
  		$reportaTesoreriaCDMX,
  		$claveSociedadTesoreria,
  		$claveIntermediarioFinanciero)
  	{

  		$this->FechaCompromisoEntrega = $fechaCompromisoEntrega;
  		$this->FechaSolicitado = $fechaSolicitado;
  		$this->FolioCliente = $folioCliente;
  		$this->ClaveOperador = $claveOperador;
  		$this->ClaveVisitador = $claveVisitador;
  		$this->ClaveEjecutivo = $claveEjecutivo;          
  		$this->ClaveProducto = $claveProducto;
  		$this->ClavePropositoAvaluo = $clavePropositoAvaluo;
  		$this->ReportaTesoreriaCDMX = $reportaTesoreriaCDMX;
  		$this->ClaveSociedadTesoreria = $claveSociedadTesoreria;
  		$this->ClaveIntermediarioFinanciero = $claveIntermediarioFinanciero;
  	}
  }


  class RespuestaSolicitudIndividual
  {


  	function RespuestaSolicitudIndividual($exito,
  		$mensaje)
  	{
  		
  		$this->Exito = $exito;
  		$this->Mensaje = $mensaje;
  	}
  }
  class Models_webservice extends CI_Model {

  	function __construct() {
  		parent::__construct();

  	}

  	public function conectar($inmuebleObj,$solicitanteObj,$visitaObje,$configuracionObj) {

  		ini_set('soap.wsdl_cache_enabled', 0);
  		$inmueble = new Inmueble($inmuebleObj->ClaveTipoInmueble, 
       $inmuebleObj->CodigoPostal,
       $inmuebleObj->ClaveEntidad,
       $inmuebleObj->ClaveMunicipio,
       $inmuebleObj->Colonia,
       $inmuebleObj->Calle,
       $inmuebleObj->NumeroExterior,
       $inmuebleObj->NumeroInterior,
       $inmuebleObj->SuperManzana,
       $inmuebleObj->Manzana,
       $inmuebleObj->Lote,
       $inmuebleObj->Condominio,
       $inmuebleObj->Entrada,
       $inmuebleObj->Edificio,
       $inmuebleObj->Departamento,
       $inmuebleObj->EntreCalle,
       $inmuebleObj->YCalle,
       $inmuebleObj->Ciudad,
       $inmuebleObj->Latitud,
       $inmuebleObj->Longitud,
       $inmuebleObj->Altitud);

  		$solicitante = new Solicitante($solicitanteObj->Nombre,
  			$solicitanteObj->ApellidoPaterno,
  			$solicitanteObj->ApellidoMaterno,
  			$solicitanteObj->PersonaMoral,
  			$solicitanteObj->Rfc,
  			$solicitanteObj->Nss,
  			$solicitanteObj->CodigoPostal,
  			$solicitanteObj->ClaveEntidad,
  			$solicitanteObj->ClaveMunicipio,
  			$solicitanteObj->Colonia,
  			$solicitanteObj->Calle,
  			$solicitanteObj->NumeroExterior,
  			$solicitanteObj->NumeroInterior,
  			$solicitanteObj->Telefono,
  			$solicitanteObj->CorreoElectronico);



  		$visita = new Visita($visitaObje->FechaVisita,
       $visitaObje->VisitaExitosa,
       $visitaObje->ContactoVisita,
       $visitaObje->Telefono);


  		$configuracion = new Configuracion($configuracionObj->FechaCompromisoEntrega,
  			$configuracionObj->FechaSolicitado,
  			$configuracionObj->FolioCliente,
  			$configuracionObj->ClaveOperador,
  			$configuracionObj->ClaveVisitador,
  			$configuracionObj->ClaveEjecutivo,
  			$configuracionObj->ClaveProducto,
  			$configuracionObj->ClavePropositoAvaluo,
  			$configuracionObj->ReportaTesoreriaCDMX,
  			$configuracionObj->ClaveSociedadTesoreria,
  			$configuracionObj->ClaveIntermediarioFinanciero);


  		$archivo = new Archivo(null,null);


  		$solicitudIndividual = new SolicitudIndividual("Vz9qvsxzKzNtryLMuhzB6BZbTRNCo7n4",
  			$configuracion,
  			$inmueble,
  			$solicitante,
  			$visita,
  			"AdminAve",
  			$archivo);



  		$client = new SoapClient("https://gysprueba.solucionideas.com/wsave.asmx?wsdl");
  		$response = $client->__soapCall("AltaAvaluo",['body' => ['solicitud' => $solicitudIndividual]]);      
      $arrayJson = json_encode((array)$response); 
      $obj = json_decode($arrayJson,TRUE);

      $array_name = array();
      foreach ($obj as $key => $value)  
      {  

        foreach ($value as $k => $v)  
        {  

          if($k=="Exito"){
           $converted_res = ($v) ? 'true' : 'false';
           $array_name[$k] = $converted_res; 
         }else{
           $array_name[$k] = $v; 
         }


       }     
     }  

     $object = (object) $array_name;

     return $object;
   }



 }