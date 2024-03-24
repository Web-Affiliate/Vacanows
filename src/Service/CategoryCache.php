<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Psr\Cache\CacheItemPoolInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categories;

class CategoryCache
{
    private $cache;
    private $entityManager;

    public function __construct(CacheItemPoolInterface $cache, EntityManagerInterface $entityManager)
    {
        $this->cache = $cache;
        $this->entityManager = $entityManager;

    }

    public function getCategoriesForToday()
    {
        $today = (new \DateTime())->format('Y-m-d H:i:s');
        $item = $this->cache->getItem('categories_for_' . $today);

        if (!$item->isHit()) {
            $categories = $this->generateRandomCategories();
            $item->set($categories);
            $item->expiresAt((new \DateTime())->modify('tomorrow'));

            $this->cache->save($item);
        }

        return $item->get();
    }

    private function generateRandomCategories()
    {
        // Récupérer les catégories depuis la base de données ou tout autre source
        $categories = $this->entityManager->getRepository(Categories::class)->findAll();

        // Mélanger les catégories
        shuffle($categories);

        // Prendre les 4 premières catégories
        $randomCategories = array_slice($categories, 0, 4);

        return $randomCategories;
    }

}


?>
