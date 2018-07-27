<?php
namespace App\Repository;

use App\Entity\Article;

/**
 * Class ArticleListRepository
 * @package App\Repository
 */
class ArticleListRepository extends AbstractRepository
{
    /**
     * @return array
     */
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