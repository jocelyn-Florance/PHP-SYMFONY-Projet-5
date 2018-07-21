<?php
namespace App\Repository;

use App\Entity\Article;

class ArticleListRepository extends AbstractRepository
{
    public function listArticle()
    {

        $article =[];

        $listeArticle = $this->getBdd()->query('SELECT * FROM articles');
          foreach ($listeArticle as $data){
            $article[] = new Article($data);
          }

        return $article;
    }

}