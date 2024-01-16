<?php 

namespace App\Controller;

use App\Entity\Item;
use App\Entity\User;
use App\Form\Type\ItemType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ItemController extends AbstractController
{
    #[Route('/items', name:'view_item')]
    public function show(EntityManagerInterface $entityManager,
                            LoggerInterface $logger,
                            PaginatorInterface $paginator,
                            Request $request): Response
    {
        $itemByPages = 10;
        $query = $entityManager->createQuery('SELECT i FROM App\Entity\Item i WHERE i.publication_date < CURRENT_DATE() AND i.isValidated = true AND i.isArchived = false');
        $logger->info('Show route /items');

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $itemByPages
        );

        return $this->render('layout.html.twig', [
            'pagination' => $pagination]);
    }

    #[Route('items/manage', name: 'manage_item')]
    public function manageItem(EntityManagerInterface $entityManager,
                            PaginatorInterface $paginator,
                            Request $request): Response
    {
        $itemByPages = 10;
        $query = $entityManager->createQuery('SELECT i FROM App\Entity\Item i WHERE i.isValidated = false AND i.isArchived = false');

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $itemByPages
        );

        return $this->render('manage.html.twig', [
            'pagination' => $pagination]);
    }

    #[Route('items/add', name: 'add_item')]
    public function addItem(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager, #[CurrentUser] User $user): Response
    {
        $item = new Item();
        $item->setName("");
        $item->setPublicationDate(new DateTime());
        $item->setCreator($user);
        
        $form = $this->createForm(ItemType::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $errors = $validator->validate($item);
            if (count($errors) > 0) {
                return new Response((string) $errors, 400);
            }
            $item = $form->getData();
            $manager->persist($item);
            $manager->flush();
            return $this->redirectToRoute('home_page');
        }

        return $this->render('login/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('items/validate?{id}', name: 'validate_item')]
    public function validateItem(EntityManagerInterface $manager, #[CurrentUser] User $user, int $id)
    {
        $item = $manager->getRepository(Item::class)->find($id);
        if (!$item) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $item->setIsValidated(true)
        ->setValidator($user)
        ->setValidationDate(new DateTime());
        $manager->flush();

        return $this->redirectToRoute('manage_item');
    }

    #[Route('items/archived?{id}', name: 'archive_item')]
    public function archiveItem(EntityManagerInterface $manager, int $id)
    {
        $item = $manager->getRepository(Item::class)->find($id);
        if (!$item) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $item->setIsArchived(true);
        $manager->flush();

        return $this->redirectToRoute('manage_item');
    }

    #[Route('items/modify?{id}', name: 'modify_item')]
    public function modifyItem(ValidatorInterface $validator, EntityManagerInterface $manager, #[CurrentUser] User $user)
    {
    }
}