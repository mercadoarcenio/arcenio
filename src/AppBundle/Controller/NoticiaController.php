<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Noticia;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;


 class NoticiaController extends Controller {
 	 public function newAction(Request $request){
 	 $helpers = $this->get(Helpers::class);
 	 $jwt_auth = $this->get(JwtAuth::class);

      $token = $request->get('authorization',null);
      $authCheck = $jwt_auth->checkToken($token);


	  if($authCheck){
	  	$identity = $jwt_auth->checkToken($token,true);
	  	$json = $request->get("json", null);

	  	if($json !== null){
	  		$params = json_decode($json);

	  		$createdAt = new \Datetime('now');
	  		$updatedAt = new \Datetime('now');



	 $user_id=($identity->sub !=null) ? $identity->sub : null;

	  		$title =(isset($params->title)) ? $params->title : null;
	  		$description = (isset($params->description)) ? $params->description : null; 
	  		$status = (isset($params->status)) ? $params->status : null;
	  		if($user_id != null && $title !=null){
	  			//crear noticia
	  			$em = $this->getDoctrine()->getManager();
	  			$user = $em->getRepository('BackendBundle:Noticia')->findOneBy(array(
	  				"id" => $user_id
	  			));
	  			if($id == null){
		  			$noticia = new Noticia();
		  			$noticia->setUser($user);
		  			$noticia->setTitle($title);
		  			$noticia->setDescription($description);
		  			$noticia->setStatus($status);
		  			$noticia->setCreatedAt($createdAt);
		  			
		$em->persist($noticia);
	    $em->flush();


	  	$data = array(
	  		"status" => "success",
	  		"code"=>200,
	  		"data"=>$noticia
	  	);
              }else{
      $noticia = $em->getRepository('BackendBundle:Noticia')->findOneBy(array(
		"id" => $id

	));

              	if(isset($identity->sub) && $identity->sub == $noticia->getUser()->getId()){


		  			$noticia->setTitle($title);
		  			$noticia->setDescription($description);
		  			$noticia->setStatus($status);
		  			$noticia->setUpdatedAt($updatedAt);
					$em->persist($noticia);
				    $em->flush();
			 
				  	$data = array(
				  		"status" => "success",
				  		"code"=>200,
				  		"data"=>$noticia
				  	);


              	}else{
	     	$data = array(
		  		"status" => "error",
		  		"code"=>200,
		  		"msg"=>'Noticia actualizado ,you not ownser'
	  	);
              	}
              }

	  	}else{
	  	$data = array(
	  		"status" => "error",
	  		"code"=>200,
	  		"msg"=>'Task not created ,validation faide'
	  	);
	  		}
	  	
	  	}else{
	  	$data = array(
	  		"status" => "success",
	  		"code"=>400,
	  		"msg"=>'Noticia no creado, parametros fallados'
	  	);
	  	}


	  }else{
	  	$data =array(
	  		"status" => "error",
	  		"code"=>400,
	  		"msg"=>'authorization invalid'
	  	);
	  }
	   return $helpers->json($data);
	}







		public function noticiaAction(Request $request){
	  $helpers = $this->get(Helpers::class);
	   $jwt_auth = $this->get(JwtAuth::class);

	  $token = $request->get('authorization',null);
	  $authCheck = $jwt_auth->checkToken($token);

	  if($authCheck){
	  	$identity = $jwt_auth->checkToken($token,true);

$em = $this->getDoctrine()->getManager();

$dql = "SELECT t FROM BackendBundle:Noticia t WHERE t user = {$identity->sub} ORDER BY t.id DESC";
$query = $em->createQuery($dql);

$page = $request->query->getInt('page',1);
$paginator = $this->get('knp_paginator');
$items_per_page = 10;

$pagination = $paginator->paginate($query,$page, $items_per_page);
$total_items_count = $pagination->getTotalItemCount();

		$data = array(
			'status' => 'succes',
			'code' => 200,
			'total_items_count' => ' $total_items_count',
			'page_actual' => $page,
			'items_per_page'=>$items_per_page,
			'total_pages'=>ceil($total_items_count / $items_per_page),
			'data'=>$pagination
		);	  	

	}else{
		$data = array(
			'status' => 'error',
			'code' => 400,
			'msg' => 'authorization not valid '
);

	}
	return $helpers->json($data);
	}




public function noticiasAction(Request $request, $id = null){
		  $helpers = $this->get(Helpers::class);
		  $jwt_auth = $this->get(JwtAuth::class);

         $token = $request->get('authorization',null);	
		  $authCheck = $jwt_auth->checkToken($token);
 if($authCheck){
  $identity = $jwt_auth->checkToken($token,  true);
  $em = $this->getDoctrine()->getManager();
   $task = $em->getRepository('BackendBundle:Noticia')->findOneBy(array(
	    'id' => $id
              
	    ));
   if($noticia && is_object($noticia) && $identity->sub == $noticia->getUser()->getId()){
	    	   
	    	  $data = array(
				'status' => 'success',
				'code' => 200,
				'data' => $noticia
	    );
	    
 }else{
 	$data = array(
 		'status' => 'error',
 		'code' =>400,
 		'msg' =>'authorization not valid'
 	);
 }
 return $helpers->json($data);
}
}



public function searchAction(Request $request, $search = null){
	$helpers = $this->get(Helpers::class);
	$jwt_auth = $this->get(JwtAuth::class);

	$token =  $request->get('authorization', null);
	$authCheck = $jwt_auth->checkToken($token);

	if($authCheck){
		$identity = $jwt_auth->checkToken($token ,true);
		$em = $this->getDoctrine()->getManager();
		$filter = $request->get('filter',null);
		if(empty($filter)){
         $filter = null;
		}elseif ($filter == 1) {
			$filter = 'new';
	}elseif ($filter == 2) {
		$filter = 'todo';
	}else{
		$filter = 'finished';
	}

	//orden
	$order = $request->get('order',null);
	if(empty($order) || $order == 2){
		$order = 'DESC';
	}
	else{
		$order = 'ASC';
	}

	//busqueda
if($search!= null){
$dql = "SELECT t FROM BackendBundle:Noticia t "
 ."WHERE t.user = $identity->sub AND "
 ."(t.title LIKE :search OR t.description LIKE :search)";

}else{
  $dql = "SELECT t FROM BackendBundle:Noticia t "
  ."WHERE t.user = $identity->sub";
}
//set filter
 if($filter != null){
   $dql .= " AND t.status = :filter";
    }
//create query

    $dql .=" ORDER BY t.id $order";

    $query = $em->createQuery($dql);
    //set parameters filer
    if($filter != null){ 
             $query->setParameter('filter', "$filter");
          }

     //set search
     if (!empty($search)) {
                $query->setParameter('search',"%$search%");
                }       

         $noticias = $query->getResult();    
		$data = array(
			'status' => 'success',
			'code' => 200,
			'data'=> $noticias
		);


	}else{
		$data = array(
			'status' => 'error',
			'code' => 400,
			'msg'=>'authorization not valid'
		);
	}

	return $helpers->json($data);

 }




public function removeAction(Request $request,$id=null){
	  $helpers = $this->get(Helpers::class);
		  $jwt_auth = $this->get(JwtAuth::class);

         $token = $request->get('authorization',null);	
		  $authCheck = $jwt_auth->checkToken($token);
 if($authCheck){
  $identity = $jwt_auth->checkToken($token,  true);
  $em = $this->getDoctrine()->getManager();
   $noticia = $em->getRepository('BackendBundle:Noticia')->findOneBy(array(
	    'id' => $id
              
	    ));
   if($noticia && is_object($noticia) && $identity->sub == $task->getUser()->getId()){
   	//borarr objeto y borrar registrode la tabla
	    	 $em->remove($noticia);
	    	 $em->flush();

	    	  $data = array(
				'status' => 'success',
				'code' => 200,
				'data' => $noticia
	    );
	    
  }else{
 	$data = array(
 		'status' => 'error',
 		'code' =>400,
 		'msg' =>'authorization not valid'
 	);
  }
 return $helpers->json($data);
 
  }
 }

}


// class NoticiaController extends Controller {
// 	public function newAction(Request $request, $id = null ){
	



