<?php

namespace App\Repository;

use App\Entity\Utilisateur;

/**
 * Class AuthentificationRepository
 * @package App\Repository
 */
class AuthentificationRepository extends AbstractRepository
{
    /**
     * @param $email
     * @param $password
     * @return Utilisateur
     */
    public function getLogin($email, $password)
    {
        $getUser = $this->getBdd()->prepare('SELECT * FROM membre WHERE email = ? AND mdp = ? ');
        $getUser->execute([$email, $password]);
        $userExist = $getUser->rowCount();

        if($userExist === 1){
          $data = $getUser->fetch(\PDO::FETCH_ASSOC);

          $user = new Utilisateur($data);

          return $user;
        }

    }
}