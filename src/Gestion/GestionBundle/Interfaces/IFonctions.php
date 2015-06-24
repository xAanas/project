<?php
namespace Gestion\GestionBundle\Interfaces;

interface IFonctions {
    
    
   
    
    // vérifier si le nombre magique $magicNumber existe ou non dans le fichier $filedrg et retourne un boolean
    public function write_log($lignedelog);
    
    
    //enlever le fichier $filedrg de la racine du serveur
    public function remove_file_drg($filedrg);
}

