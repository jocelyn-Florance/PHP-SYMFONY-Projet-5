<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ArticleRepository extends AbstractRepository
{
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

}