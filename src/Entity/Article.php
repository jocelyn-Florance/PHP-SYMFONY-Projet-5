<?php
namespace App\Entity;

/**
 * Class Article
 * @package App\Entity
 */
class Article
{
    private $id;
    private $titre;
    private $chapo;
    private $contenu;
    private $auteur;
    private $update;

    /**
     * Article constructor.
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
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function titre(){
        return $this->titre;
    }

    /**
     * @return mixed
     */
    public function chapo(){
        return $this->chapo;
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
     * @param $id
     */
    public function setId($id){
        $this->id = (int) $id;
    }

    /**
     * @param $titre
     */
    public function setTitre($titre){
        if (is_string($titre) && strlen($titre) <= 30)
        {
            $this->titre = $titre;
        }
    }

    /**
     * @param $chapo
     */
    public function setChapo($chapo){
        if (is_string($chapo) && strlen($chapo) <= 300)
        {
            $this->chapo = $chapo;
        }
    }

    /**
     * @param $contenu
     */
    public function setContenu($contenu){
        if (is_string($contenu) && strlen($contenu) <= 900)
        {
            $this->contenu = $contenu;
        }
    }

    /**
     * @param $auteur
     */
    public function setAuteur($auteur){
        if (is_string($auteur) && strlen($auteur) <= 30)
        {
            $this->auteur = $auteur;
        }
    }

    /**
     * @param $update
     */
    public function setUpdate($update){
        $this->update = $update;
    }



}