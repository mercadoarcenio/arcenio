<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Actividades;


class ActividadesController extends Controller
{
	   public function actividadesAction(Request $request)
    {
        $actividadesRepository = $this->getDoctrine()->getRepository(Actividades::class);
        $actividades = $actividadesRepository->finByTop(1);
        return $this->render('default/actividades.html.twig',array('actividades'=>$actividades));
    }

}