<?php


namespace App\Entity;


class Comment
{
    private $id;
    private $id_article;
    private $auteur;
    private $update;
    private $contenu;
    private $valider;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }


    public function hydrate(array $data)
    {

        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function id(){
        return $this->id ;
    }

    public function id_article(){
        return $this->id_article;
    }

    public function auteur(){
        return $this->auteur;
    }

    public function update(){
        return $this->update;
    }

    public function contenu(){
        return $this->contenu;
    }

    public function valider(){
        return $this->valider;
    }


    // setter

    public function setId($id){
        $this->id = (int) $id;
    }

    public function setId_article($article){
        $this->id_article = (int) $article;
    }

    public function setAuteur($auteur){
        if (is_string($auteur) && strlen($auteur) <= 30)
        {
            $this->auteur = $auteur;
        }
    }

    public function setUpdate($update){
        $this->update = $update ;
    }

    public function setContenu($contenu){
        if (is_string($contenu) && strlen($contenu) <= 800)
        {
            $this->contenu = $contenu;
        }
    }

    public function setValider($valider){
        $this->valider = (int) $valider;
    }

}