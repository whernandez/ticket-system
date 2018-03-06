<?php

namespace CompanyBundle\Controller;

use CompanyBundle\Entity\Company;
use CompanyBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Route Prefix
 *
 * @Route("/company")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/new", name="company_new")
     */
    public function createAction(Request $request)
    {
        $comp = new Company();

        $form = $this->createForm(CompanyType::class, $comp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($comp);
            $em->flush($comp);

            //return new Response("Registered Company!");
            $this->redirectToRoute('company_all');
        }

        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository("CompanyBundle:Company")->findAll();

        return $this->render(
            'CompanyBundle:Default:index.html.twig',
            array(
                'form'                  => $form->createView(),
                'companies'             => $comp,
                'page_header_title'     => Company::PAGE_HEADER_TITTLE,
                'page_header_subtitle'  => Company::PAGE_HEADER_SUBTITTLE
            )
        );
    }

    /**
     * @Route("/all", name="company_all")
     */
    public function allAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $comp = $em->getRepository("CompanyBundle:Company")->findAll();

        $form = $this->createForm(CompanyType::class, $comp);
        $form->handleRequest($request);

        return $this->render(
            'CompanyBundle:Default:index.html.twig',
            array(
                'form'                  => $form->createView(),
                'companies'             => $comp,
                'page_header_title'     => Company::PAGE_HEADER_TITTLE,
                'page_header_subtitle'  => Company::PAGE_HEADER_SUBTITTLE
            )
        );
    }
}

