<?php

namespace App\Entity;

/**
 * Class Comment
 * @package App\Entity
 */
class Comment
{
    private $id;
    private $id_article;
    private $auteur;
    private $update;
    private $contenu;
    private $valider;

    /**
     * Comment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * @param array $data
     */
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

    /**
     * @return mixed
     */
    public function id(){
        return $this->id ;
    }

    /**
     * @return mixed
     */
    public function id_article(){
        return $this->id_article;
    }

    /**
     * @return mixed
     */
    public function auteur(){
        return $this->auteur;
    }

    /**
     * @return mixed
     */
    public function update(){
        return $this->update;
    }

    /**
     * @return mixed
     */
    public function contenu(){
        return $this->contenu;
    }

    /**
     * @return mixed
     */
    public function valider(){
        return $this->valider;
    }


    /**
     * @param $id
     */
    public function setId($id){
        $this->id = (int) htmlspecialchars($id);
    }

    /**
     * @param $article
     */
    public function setId_article($article){
        $this->id_article = (int) htmlspecialchars($article);
    }

    /**
     * @param $auteur
     */
    public function setAuteur($auteur){
        if (is_string($auteur) && strlen($auteur) <= 30)
        {
            $this->auteur = htmlspecialchars($auteur);
        }
    }

    /**
     * @param $update
     */
    public function setUpdate($update){
        $this->update = $update ;
    }

    /**
     * @param $contenu
     */
    public function setContenu($contenu){
        if (is_string($contenu) && strlen($contenu) <= 800)
        {
            $this->contenu = htmlspecialchars($contenu);
        }
    }

    /**
     * @param $valider
     */
    public function setValider($valider){
        $this->valider = (int) htmlspecialchars($valider);
    }

}