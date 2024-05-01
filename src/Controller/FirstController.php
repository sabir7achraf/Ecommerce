<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends AbstractController {
    #[Route("/",name:"home")]
    function index(Request $request): Response {
return new Response("bonjour " .  $request->query->get("name", "utulisateur"));
    }
}

