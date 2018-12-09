<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;
use AppBundle\Entity\Noticia;

class DefaultController extends Controller
{

   public function indexAction(Request $request)
    {
        $noticiaRepository = $this->getDoctrine()->getRepository(Noticia::class);
        $noticia = $noticiaRepository->findAll();

        return $this->render('default/index.html.twig',array('noticia'=>$noticia));
    }

   public function loginAction(Request $request){
     $helpers = $this->get(Helpers::class);

        //Recibir json por POST
     $json = $request->get('json',null);
       //array a devolver por defecto 
        $data = array(
          'status' => 'error',
          'data' => 'Send json via post'
        );


     if($json != null){
        //mehces el login

        //convertimos un json a un objeto de php
        $params = json_decode($json);

        $email= (isset($params->email)) ? $params->email : null;
        $password = (isset($params->password)) ? $params->password : null;
        $getHash = (isset($params->getHash)) ? $params->getHash : null;
        $emailConstraint = new Assert\Email();
        $emailConstraint->message = "This email is not valid !!"; 
        $validate_email = $this->get("validator")->validate($email, $emailConstraint);
 
         $pwd = hash('sha256', $password);

         if($email != null && count($validate_email) == 0 && $password != null){
         $jwt_auth = $this->get(JwtAuth::class);


         if($getHash == null || $getHash == false){
          $signup = $jwt_auth->signup($email, $pwd);
              
         }else{
           $signup = $jwt_auth->signup($email,$pwd ,true);
         }
         return $this->json($signup);
         }else{
             $data = array(
          'status' => 'error',
          'data' => 'Email or password incorrect'
      );
         }

      
     }
     
     return $helpers->json($data);
   }

   public function pruebasAction(Request $request){
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);
        $token = $request->get("authorization",null);


    if($token && $jwt_auth->checkToken($token) == true){
    $em = $this->getDoctrine()->getManager();
    $userRepo = $em->getRepository('BackendBundle:User');
    $users = $userRepo->findAll();
    
     return $helpers->json(array(
        'status' =>'succces',
        'users' => $users
    ));

    }else{ 
         return $helpers->json(array(
        'status' =>'error',
        'code' =>400,
        'data' => 'authorization not valid'
    ));
    }

   return $data;

   }

    public function checkToken($jwt, $getIndentity = false){
        $auth = false;

        try{
        $decoded =  JWT::decode($jwt, $this->key, array('HS256'));

    }catch(\UnexpectedValueException $e){
      $auth = false;
    }catch(\DomainException $e){
      $auth = false;
    }
    if(isset($decoded) && is_object($decoded) && isset($decoded->sub)){
      $auth = true;
    }else{
       $auth = false;
    }
    if($getIndentity == false){
        return $auth;
    }else{
        return $decoded;
    }
}


}
