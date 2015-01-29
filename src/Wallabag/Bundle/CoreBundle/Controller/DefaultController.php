<?php

namespace Wallabag\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/*
 * Pour l'Api je suis l'application
 * Added a new client with public id 1_85tvwbovb8wskc4kg4oco08o08w4kkscc4s48oco80kck88c8, secret 4c20p9zsn7eocsss4gw88ko0wkk8cggswsg4ssccwoo8cwso8k
 */

class DefaultController extends Controller
{

	private $api;

    public function __construct() {
        $this->api = $this->get('api.service.request');
        $token = $api->clientAuthentification();
        $api->setAccessToken($token);
    }

    public function indexAction()
    {
    	
		$entries = $this->api->get('entries', array());
		$this->get('logger')->info($entries);

        return $this->render('WallabagCoreBundle:Default:index.html.twig', array('entries'=>$entries));
    }
}
