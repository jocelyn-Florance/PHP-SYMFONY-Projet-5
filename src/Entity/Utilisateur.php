<?php

namespace App\Entity;

/**
 * Class Utilisateur
 * @package App\Entity
 */
class Utilisateur
{
    private $id;
    private $prenon;
    private $nom;
    private $mdp;
    private $email;
    private $role;

    /**
     * Utilisateur constructor.
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
    public function id()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function prenon()
    {
        return $this->prenon;
    }

    /**
     * @return mixed
     */
    public function nom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function mdp()
    {
        return $this->mdp;
    }

    /**
     * @return mixed
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function role()
    {
        return $this->role;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param $prenon
     */
    public function setPrenon($prenon)
    {
        $this->prenon = $prenon;
    }

    /**
     * @param $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

}