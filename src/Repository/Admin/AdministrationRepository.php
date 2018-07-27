<?php
namespace App\Repository\Admin;

use App\Entity\Comment;
use App\Repository\AbstractRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class AdministrationRepository
 * @package App\Repository\Admin
 */
class AdministrationRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    public function countComment()
    {
        $comment = $this->getBdd()->query("SELECT COUNT(valider) AS valider FROM commentaire WHERE valider = 0");
        $countComment = $comment->fetch();
        $result = $countComment['valider'];
        return $result;
    }

    /**
     * @param $titre
     * @param $chapo
     * @param $auteur
     * @param $contenu
     */
    public function addArticle($titre, $chapo, $auteur, $contenu)
    {
        $article = $this->getBdd()->prepare('INSERT INTO articles (titre, chapo, contenu, auteur, articles.update) VALUES(?, ?, ?, ?, NOW()) ');
        $article->execute([$titre, $chapo, $contenu, $auteur]);
    }

    /**
     * @param $titre
     * @param $chapo
     * @param $contenu
     * @param $auteur
     * @param $id
     */
    public function EditeArticle($titre, $chapo, $contenu, $auteur, $id)
    {
        $req = $this->getBdd()->prepare('UPDATE articles SET titre = ?, chapo = ?, contenu = ?, auteur = ?, articles.update = NOW() WHERE id = ?;');
        $req->execute(array($titre, $chapo, $contenu, $auteur, $id));
    }

    /**
     * @param $titre
     * @param $id
     * @return int
     */
    public function RemoveArticle($titre, $id)
    {
        $article = $this->getBdd()->prepare('SELECT * FROM articles WHERE articles.titre = ? AND articles.id = ? ');
        $article->execute(array($titre, $id));
        $result = $article->rowCount();

        if($result === 1){
            $req = $this->getBdd()->prepare('DELETE FROM articles WHERE id = ?');
            $req->execute(array($id));
        }
        return $result;
    }

    /**
     * @param string $id
     * @return Comment|bool|\PDOStatement|RedirectResponse
     */
    public function CommentShow(string $id)
    {
        $commentaire = $this->getBdd()->prepare('SELECT * FROM commentaire WHERE commentaire.id  = :id');
        $commentaire->execute(['id' => $id]);
        $result = $commentaire->rowCount();

        if($result === 1){
            $data = $commentaire->fetch();
            $commentaire = new Comment($data);
            return $commentaire;
        }
        $response = new RedirectResponse('/404');
        return $response->send();
    }

    /**
     * @param $auteur
     * @param $contenu
     * @param $valider
     * @param $id
     */
    public function EditeCommentaire($auteur, $contenu, $valider, $id)
    {
        $req = $this->getBdd()->prepare('UPDATE commentaire SET auteur = ?, contenu = ?, valider = ?, commentaire.update = NOW() WHERE id = ?;');
        $req->execute(array($auteur, $contenu, $valider, $id));
    }

    /**
     * @param $auteur
     * @param $id
     * @return int
     */
    public function RemoveCommentaire($auteur, $id)
    {
        $commentaire = $this->getBdd()->prepare('SELECT * FROM commentaire WHERE commentaire.auteur = ? AND commentaire.id = ? ');
        $commentaire->execute(array($auteur, $id));
        $result = $commentaire->rowCount();

        if($result === 1){
            $req = $this->getBdd()->prepare('DELETE FROM commentaire WHERE id = ?');
            $req->execute(array($id));
        }
        return $result;
    }

}