<div id="affiche">
    
  <?php 
 // $select = 'select*FROM rdv where rvd_user='.$tes_id.',ASC limit '.$limite.','.$nombre;
//récupération de $limite

    if(isset($_GET['limite'])) 

        $limite=$_GET['limite'];
    else   $limite=0;


function verifLimite($limite,$total,$nombre) {

    // je verifie si limite est un nombre.

    if(is_numeric($limite)) {

        
// si $limite est entre 0 et $total, $limite est ok

        // sinon $limite n'est pas valide.

        if(($limite >=0) && ($limite <= $total) && (($limite%$nombre)==0)) {

            // j'assigne 1 à $valide si $limite est entre 0 et $max

            $valide = 1;

        }    

        else {

            // sinon j'assigne 0 à $valide

            $valide = 0;

        }

    }

    else {

            // si $limite n'est pas numérique j'assigne 0 à $valide

            $valide = 0;

    }

// je renvois $valide

return $valide;

}

function displayNextPreviousButtons($limite,$total,$nb,$page) {
$limiteSuivante = $limite + $nb;
$limitePrecedente = $limite - $nb;
echo  '<table><tr>'."\n";
if($limite != 0) {
        echo  '<td valign="top">'."\n";
        echo  '<form action="index.php" method="post">'."\n";
        echo  '<input type="submit" value="précédents">'."\n";
        echo  '<input type="hidden" value="'.$limitePrecedente.'" name="limite">'."\n";
        echo  '</form>'."\n";
        echo  '</td>'."\n";
}
if($limiteSuivante < $total) {
        echo  '<td valign="top">'."\n";
        echo  '<form action="index.php" method="post">'."\n";
        echo  '<input type="submit" value="suivants">'."\n";
        echo  '<input type="hidden" value="'.$limiteSuivante.'" name="limite">'."\n";
        echo  '</form>'."\n";
        echo  '</td>'."\n";
            
}
echo  '</tr></table>'."\n";
}
function affichePages($nb,$page,$total) {
        $nbpages=ceil($total/$nb);
        $numeroPages = 1;
        $compteurPages = 1;
        $limite  = 0;
        echo '<table border = "0" ><tr>'."\n";
        while($numeroPages <= $nbpages) {
        echo '<td ><a href = index.php"?limite='.$limite.'">'.$numeroPages.'</a></td>'."\n";
        $limite = $limite + $nb;
        $numeroPages = $numeroPages + 1;
        $compteurPages = $compteurPages + 1;
            if($compteurPages == 10) {
            $compteurPages = 1;
            echo '<br>'."\n";
            }
        }
        echo '</tr></table>'."\n";
}

//=========================================

// includes du fichier fonctions

//=========================================



//=========================================

// information pour la connection à le DB

//=========================================

$host = 'localhost';

$user = 'root';

$pass = '';

$db = 'test';
include 'conn.php';


//=========================================

// initialisation des variables 

//=========================================

// on va afficher 5 résultats par page.

$nombre = 5;  

// si limite n'existe pas on l'initialise à zéro

if (!$limite) $limite = 0; 

// on cherche le nom de la page.    

$path_parts = pathinfo($_SERVER['PHP_SELF']);

$page = $path_parts["basename"];



//=========================================    

// connection à la DB

//=========================================

//$link = mysql_connect ($host,$user,$pass) or die ('Erreur : '.mysql_error() );

//mysql_select_db($db) or die ('Erreur :'.mysql_error());



//=========================================    

// requête SQL qui compte le nombre total 

// d'enregistrements dans la table.

//=========================================

$select = 'SELECT count(rdv_id) FROM rdv';

$result = mysql_query($select)  or die ('Erreur : '.mysql_error() );

$row = mysql_fetch_row($result);

$total = $row[0];

    

//=========================================

// vérifier la validité de notre variable 

// $limite;

//=========================================

$verifLimite= verifLimite($limite,$total,$nombre);

// si la limite passée n'est pas valide on la remet à zéro

if(!$verifLimite)  {

    $limite = 0;

}

//=========================================

// requête SQL qui ne prend que le nombre 

// d'enregistrement necessaire à l'affichage.

//=========================================

//$select = 'select prenom,surnom FROM vaches ORDER BY prenom ASC limit '.$limite.','.$nombre;
$select = 'select * FROM rdv  limit '.$limite.','.$nombre;

$result = mysql_query($select)  or die ('Erreur : '.mysql_error() );

    

//=========================================    

// si on a récupéré un resultat on l'affiche.

//=========================================

if($total) {

    // début du tableau

    echo '<table bgcolor="#FFFFFF">'."\n";

        // première ligne on affiche les titres prénom et surnom dans 2 colonnes

        echo '<tr>';

        echo '<td bgcolor="#669999"><b><u>libele</u></b></td>';

        echo '<td bgcolor="#669999"><b><u>note</u></b></td>';

        echo '</tr>'."\n";

    // lecture et affichage des résultats sur 2 colonnes    

    while($row = mysql_fetch_array($result)) {

        echo '<tr>';

        echo '<td bgcolor="#CCCCCC">'.$row[1].'</td>';

        echo '<td bgcolor="#CCCCCC">'.$row[2].'</td>';

        echo '</tr>'."\n";

    }

    echo '</table>'."\n";

}

else echo 'Pas d\'enregistrements dans cette table...';

mysql_free_result($result);



//=========================================    

// si le nombre d'enregistrement à afficher 

// est plus grand que $nombre 

//=========================================

if($total > $nombre) {

    // affichage des liens vers les pages

    affichePages($nombre,$page,$total);

    // affichage des boutons

    displayNextPreviousButtons($limite,$total,$nombre,$page);

}
?>
</div>