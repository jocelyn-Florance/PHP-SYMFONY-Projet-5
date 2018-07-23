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

    public function nom()
    {
        return $this->nom;
    }

    public function prenon()
    {
        return $this->prenon;
    }

    public function email()
    {
        return $this->email;
    }

    public function message()
    {
        return $this->message;
    }

    public function setNom($nom)
    {
        $this->nom = htmlspecialchars($nom);
    }

    public function setPrenon($prenon)
    {
        $this->prenon = htmlspecialchars($prenon);
    }

    public function setEmail($email)
    {
        $this->email = htmlspecialchars($email);
    }

    public function setMessage($message)
    {
        $this->message = htmlspecialchars($message);
    }

}