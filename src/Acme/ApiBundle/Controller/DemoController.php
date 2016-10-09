<?php

namespace Acme\ApiBundle\Controller;

use Acme\GameBundle\Entity\Company;
use Acme\GameBundle\Form\CompanyType;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class DemoController
 * @package Acme\ApiBundle\Controller
 * @Route("/company")
 */
class DemoController extends FOSRestController
{
    /**
     * Этот метод позволяет создать новую компанию
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Получение списка компаний",
     *  input = {"class" = "Acme\GameBundle\Form\CompanyType", "paramType" = "query"}
     * )
     */
    public function postCompanyBanAction(Request $request) {
        $requestContent = $request->getContent();
        $data = [
            'md5'        => md5($requestContent),
            'created_at' => time()
        ];

        $form = $this->createForm(new CompanyType);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $company = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($company);
            $em->flush();

            $data['success'] = 1;
            $data['item'] = $company;
        } else {
            $data['error'] = 1;
            $data['errors'] = $form->getErrors();
        }

        $view = $this->view($data);
        return $this->handleView($view);
    }

    /**
     * Этот метод позволяет создать новую компанию
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Получение списка компаний",
     *  filters={
     *      {"name"="authToken", "dataType"="integer", "description": "Токен доступа"},
     *      {"name"="author", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"},
     *      {"name"="isPrivate", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"},
     *      {"name"="maxPlayers", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"},
     *      {"name"="minPlayers", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  }
     * )
     */
    public function postCompanyCreateAction(Request $request) {
        $requestContent = $request->getContent();
        $data = [
            'response' => $requestContent
        ];

        $view = $this->view($data);
        return $this->handleView($view);
    }

    /**
     * Этот метод позволяет получить список компаний для того, чтобы обрабатывать их в дальнейшем
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Получение списка компаний",
     *  filters={
     *      {"name"="page", "dataType"="integer"},
     *      {"name"="author", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  }
     * )
     * @Get("/find/{id}")
     */
    public function getCompanyFindAction(Request $request, Company $company)
    {
        return [
            'item' => $company
        ];
    }

    /**
     * Этот метод позволяет получить список компаний для того, чтобы обрабатывать их в дальнейшем
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Получение списка компаний",
     *  filters={
     *      {"name"="page", "dataType"="integer"},
     *      {"name"="sort", "dataType"="string"},
     *      {"name"="direction", "dataType"="string"}
     *  }
     * )
     * @Get("/all")
     * @View()
     */
    public function getCompanies(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($sort = $request->query->get('sort')) {
            $sortField = 'a.'.$sort;
            $request->query->set('sort', $sortField);
            $_GET['sort'] = $sortField;
        }

        $page = $request->query->getInt('page', 1);

        $dql   = "SELECT a FROM AcmeGameBundle:Company a";
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page,
            3
        );

        return [
            'items' => $pagination->getItems(),
            'count' => $pagination->getTotalItemCount(),
            'page'  => $page,
            'direction' => $request->query->get('direction')
        ];
    }
}
