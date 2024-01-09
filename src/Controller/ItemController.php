<?php 

namespace App\Controller;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    #[Route('/items', name:'item-view')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $items = $entityManager->getRepository(Item::class)->findAll();

        if (!$items) {
            throw $this->createNotFoundException(
                'No Items found '
            );
        }

        return $this->render('layout.html.twig', ['items'=>$items]);

        // or render a template
        // in the template, print things with {{ Item.name }}
        // return $this->render('Item/show.html.twig', ['Item' => $Item]);
    }
}