<?php

namespace App\Entity;

/**
 * Class Authentification
 * @package App\Entity
 */
class Authentification
{


    private $email;
    private $password;

    /**
     * Authentification constructor.
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
    public function email()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $email = htmlspecialchars($email);
        $this->email = $email;
    }

    /**
     * @param $password
     * @return string
     */
    public function setPassword($password)
    {
        $password = htmlspecialchars($password);
        $password = hash('sha256', $password);
        $this->password = $password;
    }


}