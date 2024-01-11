<?php 

namespace App\Controller;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    #[Route('/items/{pageNumber}', name:'item-view')]
    public function show(EntityManagerInterface $entityManager, array $_route_params, LoggerInterface $logger): Response
    {
        $itemByPages = 10;
        $logger->info('Show route /items/{pageNumber}', 
            ['pageNumber' => $_route_params['pageNumber']]);

        // $items = $entityManager->getRepository(Item::class)->findAll();
        $items = $entityManager->getRepository(Item::class)->findBy([], 
                                                    null, 
                                                    $itemByPages, 
                                                    $_route_params['pageNumber'] * $itemByPages);

        if (!$items) {
            $logger->error('No Items Found');
            throw $this->createNotFoundException(
                'No Items found '
            );
        }

        return $this->render('layout.html.twig', ['items' => $items]);
    }
}