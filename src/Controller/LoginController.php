<?php 

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login-page')]
    public function new(Request $request): Response
    {
        $user = new User();
        $user->setRole("rédacteur");
        $user->setRole("rédacteur");
        
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            return $this->redirectToRoute('home_page');
        }

        return $this->render('task/login.html.twig', [
            'form' => $form,
        ]);
    }
}