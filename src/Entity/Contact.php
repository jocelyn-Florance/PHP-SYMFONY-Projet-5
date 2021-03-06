<?php

namespace App\Entity;

/**
 * Class Contact
 * @package App\Entity
 */
class Contact
{
    private $nom;
    private $prenon;
    private $email;
    private $message;

    /**
     * Contact constructor.
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
    public function nom()
    {
        return $this->nom;
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
    public function email()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * @param $nom
     */
    public function setNom($nom)
    {
        $this->nom = htmlspecialchars($nom);
    }

    /**
     * @param $prenon
     */
    public function setPrenon($prenon)
    {
        $this->prenon = htmlspecialchars($prenon);
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = htmlspecialchars($email);
    }

    /**
     * @param $message
     */
    public function setMessage($message)
    {
        $this->message = htmlspecialchars($message);
    }

}