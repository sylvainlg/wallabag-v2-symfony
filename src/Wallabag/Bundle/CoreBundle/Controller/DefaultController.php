<?php

namespace Wallabag\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/*
 * Pour l'Api je suis l'application
 * Added a new client with public id 1_85tvwbovb8wskc4kg4oco08o08w4kkscc4s48oco80kck88c8, secret 4c20p9zsn7eocsss4gw88ko0wkk8cggswsg4ssccwoo8cwso8k
 */

class DefaultController extends Controller
{

    public function __construct() {
        
    }

    public function indexAction()
    {
    	
    	/*$api = $this->get('api.service.request');
        $token = $api->clientAuthentification();
        var_dump($token);*/
        /*$api->setAccessToken($token);
		$entries = $api->get('entries', array());*/

		
		$credentialsClient = $this->get('api.service.client.credentials_client');
        $accessToken = $credentialsClient->getAccessToken();
        /*var_dump(sprintf('Obtained Access Token: <info>%s</info>', $accessToken));

        $url = 'http://oauth-server.local/api/articles';
        var_dump(sprintf('Requesting: <info>%s</info>', $url));
        $response = $credentialsClient->fetch($url);
        var_dump(sprintf('Response: <info>%s</info>', var_export($response, true)));*/


		$entries = array();
		$this->get('logger')->info(implode(',',$entries));

        return $this->render('WallabagCoreBundle:Default:index.html.twig', array('entries'=>$entries));
    }
}
