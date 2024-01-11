<?php 

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/role')]
    public function role(#[CurrentUser] ?User $user): Response
    {
        $user->getRoles();
    }

    #[Route('/user')]
    public function user(): Response
    {
        $this->getUser();
    }

}