<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Form\UserType;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

/**
 * Route Prefix
 *
 * @Route("/user")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home_user")
     */
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig', array(
            'page_header_title'     => 'Tickets Portal',
            'page_header_subtitle'  => 'Users Profile'
        ));

    }

    /**
     * @Route("/register", name="user_registration")
     * @param Request $request
     * @return string
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $encoder = $this->get('security.encoder_factory')
                ->getEncoder($user);
            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return new Response("Registered User!");
        }

        return $this->render(
            'UserBundle:Default:register.html.twig',
            array(
                    'form'                  => $form->createView(),
                    'page_header_title'     => 'Users Registration',
                    'page_header_subtitle'  => 'Create User'
                )
        );
    }

}
