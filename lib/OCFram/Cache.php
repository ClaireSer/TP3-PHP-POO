<?php
class Cache {
    private $validityDuration = 3600;

    // lit le fichier cache
    public function readCache($nomFichier) {
        readfile($nomFichier);
    }
    // met en cache les données
    public function writeCache($nomFichier, $contentFichier) {
        file_put_contents($nomFichier, $contentFichier);
    }
    // supprime le fichier cache
    public function deleteCache($nomFichier) {
        clearstatcache($nomFichier); // pas sûr que ça soit la bonne fonction...
    }
    // vérifie si un fichier est à jour
    public function isUpToDate($nomFichier) {
        return filemtime($nomFichier) > time() - $validityDuration;
    }
    // vérifie si un fichier cache existe
    public function exists($nomFichier) {
        return file_exists($nomFichier);
    }   
}