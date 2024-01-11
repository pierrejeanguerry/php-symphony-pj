<?php 

namespace App\Controller;

use App\Entity\Login;
use App\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends AbstractController
{

    public function new(Request $request): Response
    {
        $login = new Login();
        $login->setUsername("");
        $login->setPassword("");
        
        $form = $this->createForm(LoginType::class, $login);

        return $this->render('task/login.html.twig', [
            'form' => $form,
        ]);
    }
}