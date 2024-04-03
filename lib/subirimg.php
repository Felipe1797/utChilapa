<?php 
class subirimg{
    
    protected $ext = array (
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/JPG'
    );
    
    protected $carpeta = "";
    protected $rightName = null;
    protected $mensajes = array();
    protected $nombrei = array();
    
    public function __construct($carpeta){
        $this->carpeta = $carpeta;
        if (!file_exists($carpeta) ){
            throw new exception("No hay carpeta de subida");
        }
    }
    
    public function doSubir(){
        $archivo = current($_FILES);
        if(is_array($archivo['name'])){
            foreach ($archivo['name'] as $clave => $valor){
                $multiarchivo['name'] = $archivo['name'][$clave];
                $multiarchivo['type'] = $archivo['type'][$clave];
                $multiarchivo['tmp_name'] = $archivo['tmp_name'][$clave];
                $multiarchivo['error'] = $archivo['error'][$clave];
                $multiarchivo['size'] = $archivo['size'][$clave];
                
                if($this->chekArchivos($multiarchivo)){
                    $this->moveArchivos($multiarchivo);
                }
            }
        }else{
          if($this->chekArchivos($archivo)){
                $this->moveArchivos($archivo);
            }  
        }
    }
    
    public function mensages(){
        return $this->mensajes;
    }
    
    public function nomimg(){
        return $this->nombrei;
    }
    
    protected function servTop($archivo){
        $serverLimit = self::getIntBytes(ini_get('upload_max_filesize'));
        if($serverLimit > $archivo['size']){
            return true;
        }else{
            $this->mensajes[]= "El servidor ha bloquedo la subida";
        }
    }
    
    protected function chekArchivos($archivo){
        if(!$this->servTop($archivo)){
            return false;
        }
        if(!$this->checkMime($archivo)){
            return false;
        }
        $this->checkSpace($archivo);
        if($archivo['error'] == 0){
            return true;
        }else{
            $this->errores($archivo);
            return false;
        }
    }
    
    protected function checkSpace($archivo){
        $newName = str_replace(' ','_',$archivo['name']);
        if($newName != $archivo ['name']){
            $this->rightName = $newName;
        }
        $nombreDividido = pathinfo($newName);
        $nombre = isset($this->rightName) ? $this->rightName : $archivo ['name'];
        $duplicado = scandir($this->carpeta);
        if(in_array($nombre, $duplicado)){
            $i = 1;
            do{
                $this->rightName = $nombreDividido['filename'].'_'.$i++.'.'.$nombreDividido['extension'];
            }
            while (in_array($this->rightName, $duplicado));
        }
    }
    
    protected function checkMime($archivo){
        if(in_array($archivo ['type'], $this->ext)){
           return true; 
        }else{
            $this->mensajes[]= "El tipo de archivo no es valido";
        }
    }
    
    protected function errores($archivo){
        switch ($archivo['error']){
            case 2:
                $this->mensajes[]= 'El archivo no se pudo subir, es demasiado grande';
                break;
            case 4:
                $this->mensajes[]= 'No se ha seleccionado un archivo';
                break;
            default:
                $this->mensajes[]= 'El archivo no se pudo subir';
                break;
        }
    }
    
    protected function moveArchivos($archivo){
        
        $nombreArchivo = isset($this->rightName) ? $this->rightName : $archivo['name'];
        $salida = move_uploaded_file($archivo ['tmp_name'], $this->carpeta . $nombreArchivo);
        
        if($salida){
           if($this->rightName != null){
                $this->mensajes[] = $archivo['name'].' Se ha subido y renombrado a: '.$this->rightName;
               $this->nombrei[] = $this->rightName;
            }else{
                $this->mensajes[] = $archivo['name'].' Se ha subido';
               $this->nombrei[] = $archivo['name'];
            } 
        }
    }
    
    protected function getIntBytes($serverMb){
        $serverMb = trim($serverMb);
        $newSize = strtolower($serverMb[strlen($serverMb)-1]);
        if(in_array($newSize, array('g','m','k'))){
            switch ($newSize){
                case 'g':
                    $serverMb *= 1073741824;
                    break;
                case 'm':
                    $serverMb *= 1048576;
                    break;
                case 'k':
                    $serverMb *= 1024;
                    break;
            }
        }
        return $serverMb;
    }
}

?>