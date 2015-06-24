<?php
namespace Gestion\GestionBundle\Implementation;

use Gestion\GestionBundle\Interfaces\IFonctions;

class Fonctions implements IFonctions {

    

    

    function write_log($lignedelog) {
        
        $fichierlog = fopen('E://logs/'. date("m.d.y").'.txt', 'a+');
        /* .date("y").'/'.date("m").'/' */
        fputs($fichierlog,$lignedelog);
        
        fclose($fichierlog);

        
    }

   

    public function remove_file_drg($filedrg) {
        unlink(basename($filedrg));
    }

}

