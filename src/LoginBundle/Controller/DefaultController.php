<?php

namespace LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="login_index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('LoginBundle:Default:index.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

    }

    /**

     * @Route("/logout", name="logout_app")

     */
    public function logoutAction()
    {

        throw new \Exception('this should not be reached!');
        
    }
}
