<?php

# src/Wallabag/Bundle/CoreBundle/Controller/SecurityController.php

namespace Wallabag\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpFoundation\Response;

use Wallabag\Bundle\CoreBundle\Entity\User;

/*
2_5psk8oz4k58g8wg0w8gs8cgwssw0ws8c4cos40ow4448c4400s
3ssuz3bb4xwk8s0gso00cgow0gc48kw8cwk4gswkgkc0wksccs

Added a new client with public id 3_54krpne7cxwkcg08848cskkcc4coks0ccks048g088oogs0gw8, secret 2vzxc3hw3i80g4ok8c00cgg0owcoc84coo4s80g0so0ksg04g

client_id=3_54krpne7cxwkcg08848cskkcc4coks0ccks048g088oogs0gw8&response_type=code&redirect_uri=http://192.168.1.22:8080/

/oauth/v2/token?client_id=3_54krpne7cxwkcg08848cskkcc4coks0ccks048g088oogs0gw8&client_secret=2vzxc3hw3i80g4ok8c00cgg0owcoc84coo4s80g0so0ksg04g&grant_type=authorization_code&redirect_uri=http://192.168.1.22:8080/&code=ZDY1NTQ3ZGIyZWRiYjM3NjBlNzIyMjBjNWM3ZDNjZjAwNDI3ZmQyNWRjNjYwZDdmZDVlNmM0MzQxMDFlOTExZA

Password flow
PROVIDER_HOST/oauth/v2/token?client_id=3_54krpne7cxwkcg08848cskkcc4coks0ccks048g088oogs0gw8&client_secret=2vzxc3hw3i80g4ok8c00cgg0owcoc84coo4s80g0so0ksg04g&grant_type=password&username=abcde&password=abcde


*/

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            $error = $error->getMessage(
            ); // WARNING! Symfony source code identifies this line as a potential security threat.
        }

        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        return $this->render(
            'WallabagCoreBundle:Security:login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error' => $error,
            )
        );
    }

    public function loginCheckAction(Request $request)
    {
        //return 'ok';

        /*
         * Bad credetials => varchar(100) for password field in db
         */
    }

    public function createUserAction($email,$password) {

        $factory = $this->get('security.encoder_factory');

        $user = new User();

        $encoder = $factory->getEncoder($user);
        $user->setSalt(md5(time()));
        $pass = $encoder->encodePassword($password, $user->getSalt());
        $user->setEmail($email);
        $user->setPassword($pass);
        $user->setActive(true); //enable or disable

        $user->setUsername($email);
        $user->setFeedToken('');
        $user->setAuthGoogleToken('');
        $user->setAuthMozillaToken('');
        $user->setLocale('fr');
        $user->setPageSize(15);
        $user->setSortDirection('asc');
        $user->setTheme('default');
        //username, email, salt, password, is_active, feedToken, authGoogleToken, authMozillaToken, locale, pageSize, sortDirection, theme

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('Sucessful');
    }
}