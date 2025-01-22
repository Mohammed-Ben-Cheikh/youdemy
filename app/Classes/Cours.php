<?php
require_once 'GetSet.php';
// Classe de base pour les cours
class Cours extends GetSetClass
{
    protected $titre;
    protected $description;
    protected $id_enseignant_fk;
    protected $image_url;
    protected $id_categorie_fk;

    public function __construct($titre, $description, $image_url, $id_enseignant_fk = null, $id_categorie_fk = null)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->id_enseignant_fk = $id_enseignant_fk;
        $this->id_categorie_fk = $id_categorie_fk;
    }
}
