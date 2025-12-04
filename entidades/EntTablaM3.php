<?php

class EntTablaM3{
        private ?string $id;
	    private ?string $numero_edificio;
	    private ?string $numero_nivel;
	    private ?string $id_usuario;
	    private ?string $cct;
        private ?string $estatus;
	
       
    public function __construct(
         ?string $id,
         ?string $numero_edificio,
         ?string $numero_nivel,
         ?string $id_usuario,
         ?string $cct,
         ?string $estatus
        )
    {
        $this->id = $id;
        
        $this->numero_edificio=$numero_edificio;
        $this->numero_nivel=$numero_nivel;
        $this->id_usuario=$id_usuario;
        $this->cct=$cct;
        $this->estatus=$estatus;

       
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
    public function getNumeroEdificio() {
        return $this->numero_edificio;
    }
    // metodo sett
    public function setNumeroEdificio($Valor) {
        $this->numero_edificio = $Valor; 
    }


    //metodo get
    public function getNumeroNivel() {
        return $this->numero_nivel;
    }
    // metodo sett
    public function setNumeroNivel($Valor) {
        $this->numero_nivel = $Valor; 
    }


    //metodo get
    public function getIdUsuario() {
        return $this->id_usuario;
    }
    // metodo sett
    public function setIdUsuario($Valor) {
        $this->id_usuario = $Valor; 
    }


    //metodo get
    public function getCct() {
        return $this->cct;
    }
    // metodo sett
    public function setCct($Valor) {
        $this->cct = $Valor; 
    }


    //metodo get
    public function getEstatus() {
        return $this->estatus;
    }
    // metodo sett
    public function setEstatus($Valor) {
        $this->estatus = $Valor; 
    }





}	




?>