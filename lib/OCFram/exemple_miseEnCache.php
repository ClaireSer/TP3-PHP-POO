<?php
$fichierCache = 'cache/index.html';
$dateExpire = time() - 3600;

// vérifie si le fichier existe et s'il est à jour'
if (filemtime($fichierCache) < $dateExpire OR !file_exists($fichierCache)) {
    // met en cache les données
    ob_start();
    $retour = mysql_query('SELECT id, titre, date, contenu FROM news ORDER BY id DESC LIMIT 0, 10') or die (mysql_error());

    while ($donnees = mysql_fetch_array($retour)) {
        echo '<div class="news">
        <h3>'.$donnees['titre'].'</h3>
        le '.date('d/m/Y à H\hi', $donnees['date']).'<br />';
        echo zcode($donnees['contenu']).'</div>';
    }  

    $tampon = ob_get_contents();
    ob_end_clean();
    file_put_contents($fichierCache, $tampon);
    echo $tampon;
    
} else {
    // lit le fichier cache
    readfile($fichierCache);
}
?>
