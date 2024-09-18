<?php

namespace App\Tests\Entity;

use App\Entity\SousCategories2;
use App\Entity\Articles;
use PHPUnit\Framework\TestCase;

class SousCategories2Test extends TestCase
{
    public function testAddRemoveArticles()
    {
        $sousCategorie = new SousCategories2();
        $article = new Articles();
        $article->setLibelles('Test Article');

        $this->assertCount(0, $sousCategorie->getArticles());

        $sousCategorie->addArticle($article);
        $this->assertCount(1, $sousCategorie->getArticles());
        $this->assertSame($article, $sousCategorie->getArticles()->first());

        $sousCategorie->removeArticle($article);
        $this->assertCount(0, $sousCategorie->getArticles());
    }
}
