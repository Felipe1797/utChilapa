<?php 

class database{
    
    public $db;
    protected $resultado;
    protected $prep;
    protected $consulta;
    
    public function __construct($dbhost, $dbuser, $dbpass, $dbname){
        
        $this->db = new mysqli ($dbhost, $dbuser, $dbpass, $dbname);
        
        if ($this->db->connect_errno){
            
            trigger_error("Fallo en la conexón con Mysql, Tipo de error -> ({$this->db->connect_error}) ");
            
        }
        
        $this->db->set_charset('utf8');
    }
    
    public function getAssoc(){
        return $this->resultado->fech_assoc();
    }
    
    public function preparar($consulta){
        $this->consulta = $consulta;
        $this->prep = $this->db->prepare($this->consulta);
        if(!$this->prep){
            trigger_error("Error en la consulta");
        }else{
            return true;
        }
    }
    
    public function ejecutar(){
        $this->prep->execute();
    }

    public function prep(){
        return $this->prep;
    }
    
    public function resultado(){
        return $this->prep->fetch(); 
    }
    
    public function cambiarDatabase ($db){
        $this->db->select_db($db);
    }

    public function liberar(){
        $this->prep->free_result();
    }
    
    public function filasAfectadas(){
        $this->prep->affected_rows;
    }
    
    public function validarDatos($columna, $tabla, $condicion){
        $this->resultado = $this->db->query("SELECT $columna FROM $tabla WHERE $columna = '$condicion' ");
        $check = $this->resultado->num_rows;
        return $check;
    }
    public function cerrar(){
        $this->prep->close();
        $this->db->close();
    }
}

?>