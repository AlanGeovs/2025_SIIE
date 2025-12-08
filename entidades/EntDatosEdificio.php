<?php

class EntDatosEdificio{
private ?string $id ;
private ?string $nombre_articulo ;
private ?string $existencia ;
private ?string $tipo_construccion ;
private ?string $cantidad ;
private ?string $en_usu ;
private ?string $condicion ;
private ?string $con_dano_estructural ;
private ?string $con_dano_instalacion ;
private ?string $obra_en_proceso ;
private ?string $tipo_obra ;
private ?string $recursos ;
private ?string $requiere_ca ;
private ?string $liga ;
private ?string $iddetalle_area ;
private ?string $id_usuario ;
	
       
    public function __construct(
 ?string $id ,
  ?string $nombre_articulo ,
 ?string $existencia ,
 ?string $tipo_construccion ,
 ?string $cantidad ,
 ?string $en_usu ,
 ?string $condicion ,
 ?string $con_dano_estructural ,
 ?string $con_dano_instalacion ,
 ?string $obra_en_proceso ,
 ?string $tipo_obra ,
 ?string $recursos ,
 ?string $requiere_ca ,
 ?string $liga ,
 ?string $iddetalle_area ,
 ?string $id_usuario 
        )
    {
$this->id= $id ;
$this->nombre_articulo= $nombre_articulo ;
$this->existencia= $existencia ;
$this->tipo_construccion= $tipo_construccion ;
$this->cantidad= $cantidad ;
$this->en_usu= $en_usu ;
$this->condicion= $condicion ;
$this->con_dano_estructural= $con_dano_estructural ;
$this->con_dano_instalacion= $con_dano_instalacion ;
$this->obra_en_proceso= $obra_en_proceso ;
$this->tipo_obra= $tipo_obra ;
$this->recursos= $recursos ;
$this->requiere_ca= $requiere_ca ;
$this->liga= $liga ;
$this->iddetalle_area= $iddetalle_area ;
$this->id_usuario= $id_usuario ;

       
    }
    //metodo get
    public function getId() {
        return $this->id;
    }
    // metodo set
    public function setId($Valor) {
        $this->id = $Valor; 
    }
    //metodo get
    public function getNombreArticulo() {
        return $this->nombre_articulo;
    }
    // metodo sett
    public function setNombreArticulo($Valor) {
        $this->nombre_articulo = $Valor; 
    }
    //metodo get
    public function getExistencia() {
        return $this->existencia;
    }
    // metodo sett
    public function setExistencia($Valor) {
        $this->existencia = $Valor; 
    }


    //metodo get
    public function getTipoC() {
        return $this->tipo_construccion;
    }
    // metodo sett
    public function setTipoC($Valor) {
        $this->tipo_construccion = $Valor; 
    }


    //metodo get
    public function getCantidad() {
        return $this->cantidad;
    }
    // metodo sett
    public function setCantidad($Valor) {
        $this->cantidad = $Valor; 
    }


    //metodo get
    public function getEU() {
        return $this->en_usu;
    }
    // metodo sett
    public function setEU($Valor) {
        $this->en_usu = $Valor; 
    }


    //metodo get
    public function getCondicion() {
        return $this->condicion;
    }
    // metodo sett
    public function setCondicion($Valor) {
        $this->condicion = $Valor; 
    }
     //metodo get
    public function getCDE() {
        return $this->con_dano_estructural;
    }
    // metodo sett
    public function setCDE($Valor) {
        $this->con_dano_estructural = $Valor; 
    }
     //metodo get
    public function getCDI() {
        return $this->con_dano_instalacion;
    }
    // metodo sett
    public function setCDI($Valor) {
        $this->con_dano_instalacion = $Valor; 
    }
     //metodo get
    public function getOp() {
        return $this->obra_en_proceso;
    }
    // metodo sett
    public function setOp($Valor) {
        $this->obra_en_proceso = $Valor; 
    }
     //metodo get
    public function getTipoObra() {
        return $this->tipo_obra;
    }
    // metodo sett
    public function setTipoObra($Valor) {
        $this->tipo_obra = $Valor; 
    }
     //metodo get
    public function getRecursos() {
        return $this->recursos;
    }
    // metodo sett
    public function setRecursos($Valor) {
        $this->recursos = $Valor; 
    }
     //metodo get
    public function getRCA() {
        return $this->requiere_ca;
    }
    // metodo sett
    public function setRCA($Valor) {
        $this->requiere_ca = $Valor; 
    }
     //metodo get
    public function getLiga() {
        return $this->liga;
    }
    // metodo sett
    public function setLiga($Valor) {
        $this->liga = $Valor; 
    }
     //metodo get
    public function getIdDetalleArea() {
        return $this->iddetalle_area;
    }
    // metodo sett
    public function setIdDetalleArea($Valor) {
        $this->iddetalle_area = $Valor; 
    }

     //metodo get
    public function getidUsuario() {
        return $this->id_usuario;
    }
    // metodo sett
    public function setIdusuario($Valor) {
        $this->id_usuario = $Valor; 
    }





}	




?>