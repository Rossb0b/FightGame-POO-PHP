<?php

require '../model/global.php';

function chargerClasse($classname)
{
  require_once '../model/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

session_start();
$db = connect();
$manager = new PersonnageManager($db);



if (isset($_POST['name']) && isset($_POST['create']))
{
    
    $perso = new Personnage 
    ([
        'name' => $_POST['name']
    ]);
        
        
    $manager->add($perso);
}


elseif (isset($_POST['name']) && isset($_POST['use']))
{
    if ($manager->count($_POST['name']) > 0)
    {
        $perso = $manager->getPersonnage($_POST['name']);
        $_SESSION['perso'] = $perso;
    }
    else
    {
        $message = "Ce personnage n'existe pas !";
    }
}

elseif (isset($_GET['hitting']))
{
    var_dump(isset($_SESSION['perso']));
    if(!isset($_SESSION['perso']))
    {
        $message = "Veuillez créer/utiliser un personnage.";
    }
    else
    {
        $persoToHit = $manager->getPersonnage($_GET['hitting']);

        $return = $_SESSION['perso']->attack($persoToHit);
        var_dump($return);
        if($return == Personnage::Its_myself)
        {
            $message = "But.. Why would I hit myself ?!";
        }
        if($return == Personnage::Personnage_attack)
        {
            $message = "You did hit the target.";

            $manager->update($_SESSION['perso']);
            $manager->update($persoToHit);
        }
        if($return == Personnage::Personnage_died)
        {
            $message = "You killed this one !";

            $manager->update($_SESSION['perso']);
            $manager->delete($persoToHit);
        }
    }        
} 

$persos = $manager->listPersonnages();
    
include "../views/indexVue.php";
?>
