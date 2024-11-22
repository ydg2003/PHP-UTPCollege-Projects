<?php
class EventData {
    public $nombre;
    public $apellido;
    public $edad;
    public $sexo;
    public $pais_residencia;
    public $nacionalidad;
    public $celular;
    public $correo;
    public $temas;
    public $observaciones;
    public $fecha;

    public function __construct($data) {
        // Set the form data to class properties, sanitize if necessary
        $this->nombre = ucfirst(strtolower($data['nombre']));
        $this->apellido = ucfirst(strtolower($data['apellido']));
        $this->edad = intval($data['edad']);
        $this->sexo = $data['sexo'];
        $this->pais_residencia = $data['pais_residencia'];
        $this->nacionalidad = $data['nacionalidad'];
        $this->celular = $data['celular'];
        $this->correo = $data['correo'];
        $this->temas = implode(', ', $data['temas']); // Convert array to comma-separated string
        $this->observaciones = $data['observaciones'];
        $this->fecha = $data['fecha']; // Auto-generated date
    }
}