<?php 

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login_page')]
    public function new(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $user = new User();
        $user->setUsername("");
        $user->setRoles(["ROLE_USER"]);
        $user->setRole("rédacteur");
        $user->setPassword("");
        
        $error = $authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
        }

        return $this->render('login/index.html.twig', [
            'form' => $form,
            'error' => $error
        ]);
    }
}