<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class AuthentificationRepository
 * @package App\Repository
 */
class AuthentificationRepository extends AbstractRepository
{

    /**
     * @param $email
     * @param $password
     * @return array|RedirectResponse
     * @throws \Exception
     */
    public function getLogin($email, $password)
    {
        $getUser = $this->getBdd()->prepare('SELECT * FROM membre WHERE email = ? AND mdp = ? ');
        $getUser->execute([$email, $password]);
        $userExist = $getUser->rowCount();

        if($userExist === 1){
          $data = $getUser->fetch(\PDO::FETCH_ASSOC);
          $user = new Utilisateur($data);

            $token = random_bytes(15);
            $token = bin2hex($token);

            $_SESSION['token'] = $token;
            $_SESSION['email'] = $user->email();
            $_SESSION['prenon'] = $user->prenon();
            $_SESSION['role'] = $user->role();

            $response = new RedirectResponse('/administration/'. $token);
            return $response->send();

        }
          return $_SESSION['erreur'] = ['type' => 'alert-danger', 'content' => 'Pas d\'utilisateur'];
    }
}