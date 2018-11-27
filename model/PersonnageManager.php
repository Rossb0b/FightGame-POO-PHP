<?php

declare(strict_types = 1);

class PersonnageManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function count($postName)
    {
        $req = $this->_db->query('SELECT name FROM personnages WHERE name = "'.$postName.'"');
        $checkPseudo = $req->rowCount();
        return $checkPseudo;
    }

    public function add(Personnage $perso)
    {
        $req = $this->_db->prepare('INSERT INTO personnages (name, damage) VALUES(:name, :damage)');

        $req->bindValue(':name', $perso->get_name(), PDO::PARAM_STR);
        $req->bindValue(':damage', 0, PDO::PARAM_INT);

        $req->execute();
    }

    public function delete(Personnage $perso)
    {
        $req = $this->_db->exec('DELETE FROM personnages WHERE id = '. $perso->id());
    }

    public function update(Personnage $perso)
    {
        $req = $this->_db->prepare('UPDATE personnages SET damage = :damage WHERE id = :id');
        
        $req->bindValue(':damage', $perso->damage(), PDO::PARAM_INT);
        $req->execute();
    }



    public function getPersonnage($name)
    {
        $req = $this->_db->query('SELECT * FROM personnages WHERE name = "' . $name . '"');

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        return new Personnage($donnees);
    }

    public function listPersonnages()
    {
        $persos = [];

        $req = $this->_db->query('SELECT * FROM personnages');

        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $persos[] = new Personnage($data);
        }

        return $persos;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

$db = connect();



