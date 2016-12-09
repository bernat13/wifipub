<?php

namespace A\WifiPubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$mensaje=  date('d-m-Y');
    	 $params = array('titulo'=>"Inicio",'mensaje' =>$mensaje,);
        return $this->render('AWifiPubBundle:Default:index.html.twig',$params);
    }

    
}
