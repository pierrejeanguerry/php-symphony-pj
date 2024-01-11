<?php 

namespace App\Controller;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    #[Route('/items/{pageNumber}', name:'item-view')]
    public function show(EntityManagerInterface $entityManager, array $_route_params): Response
    {
        $itemByPages = 10;
        // $items = $entityManager->getRepository(Item::class)->findAll();
        $items = $entityManager->getRepository(Item::class)->findBy([], null, $itemByPages, $_route_params['pageNumber'] * $itemByPages);

        if (!$items) {
            throw $this->createNotFoundException(
                'No Items found '
            );
        }

        return $this->render('layout.html.twig', ['items' => $items]);
    }
}