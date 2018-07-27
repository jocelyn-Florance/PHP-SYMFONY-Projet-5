<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class ArticleRepository
 * @package App\Repository
 */
class ArticleRepository extends AbstractRepository
{

    /**
     * @param string $id
     * @return Article|bool|\PDOStatement|RedirectResponse
     */
    public function ArticleShow(string $id)
    {
        $article = $this->getBdd()->prepare('SELECT * FROM articles WHERE articles.id  = :id');
        $article->execute(['id' => $id]);
        $result = $article->rowCount();

        if($result === 1){
            $data = $article->fetch();
            $article = new Article($data);
            return $article;
        }
        $response = new RedirectResponse('/404');
        return $response->send();
    }

    /**
     * @param string $id
     * @return array
     */
    public function CommentShow(string $id)
    {
        $comment = [];
        $listcomment = $this->getBdd()->prepare('SELECT * FROM articles LEFT JOIN commentaire ON articles.id = commentaire.id_article WHERE articles.id = :id');
        $listcomment->execute(['id' => $id]);
            foreach ($listcomment as $data ){
                $comment[] = new Comment($data);
            }
            return $comment;
    }

    /**
     * @return array
     */
    public function ListeArticle()
    {
        $listArticle = [];
        $article = $this->getBdd()->query('SELECT * FROM articles');
        $article->execute();
        foreach ($article as $data ){
            $listArticle[] = new Article($data);
        }
        return $listArticle;
    }

    /**
     * @return array
     */
    public function ListeCommentaire()
    {
        $listCommentaire = [];
        $commentaire = $this->getBdd()->query('SELECT * FROM commentaire');
        $commentaire->execute();
        foreach ($commentaire as $data ){
            $listCommentaire[] = new Comment($data);
        }
        return $listCommentaire;
    }

    /**
     * @param $id_article
     * @param $auteur
     * @param $contenu
     */
    public function AddCommentaire($id_article, $auteur, $contenu)
    {
        $commentaire = $this->getBdd()->prepare('INSERT INTO commentaire (id_article, auteur, contenu, commentaire.update) VALUES(?, ?, ?, NOW())');
        $commentaire->execute([$id_article, $auteur, $contenu]);
    }


}