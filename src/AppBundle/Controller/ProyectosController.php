<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Proyectos;


class ProyectosController extends Controller
{
	   public function proyectosAction(Request $request)
    {
        $proyectosRepository = $this->getDoctrine()->getRepository(Proyectos::class);
        $proyectos = $proyectosRepository->findAll();
        return $this->render('default/proyectos.html.twig',array('proyectos'=>$proyectos));
    }

}