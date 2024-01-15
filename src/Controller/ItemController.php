<?php 

namespace App\Controller;

use App\Entity\Item;
use App\Form\Type\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ItemController extends AbstractController
{
    #[Route('/items/show/{pageNumber}', name:'item-view')]
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

    #[Route('items/add', name: 'add_item')]
    public function addItem(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        $item = new Item();
        $item->setName("");
        
        $form = $this->createForm(ItemType::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $errors = $validator->validate($item);
            if (count($errors) > 0) {
                return new Response((string) $errors, 400);
            }
            $item = $form->getData();
            // print_r($item);
            $manager->persist($item);
            $manager->flush();
            return $this->redirectToRoute('home_page');
        }

        return $this->render('login/index.html.twig', [
            'form' => $form,
        ]);
    }
}