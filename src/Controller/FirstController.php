<?php

namespace App\Controller;

use App\service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends AbstractController {
    #[Route("/",name:"home")]
    function index(MailerService $mailerService): Response {
        $mailerService->sendMail();
return $this->render('first/index.html.twig');
    }
}

