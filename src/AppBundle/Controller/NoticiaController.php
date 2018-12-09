<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;

class NoticiaController extends Controller
{
    public function noticiaAction(Request $request)
    {
       $repository = $this->getDoctrine()->getRepository(Noticia::class);
        return $this->render('default/noticia.html.twig');
    }
}	