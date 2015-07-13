<?php
namespace Gestion\GestionBundle\Interfaces;

interface IFonctions {
    
    
   
    
    public function write_log($lignedelog);
    
    
    //enlever le fichier $filedrg de la racine du serveur
    public function remove_file_drg($filedrg);
}

