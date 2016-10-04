<?php

namespace Acme\ApiBundle\Controller;

use Acme\GameBundle\Entity\Company;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class DemoController extends FOSRestController
{
    public function getDemosAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');

        $company = new Company();
        $company->setTitle('Тестовая компания #'.time());
        $company->setGameId(1);
        $company->setPlayersLimit(10);
        $company->setPrisesGiven(mt_rand(1, 12));
        $company->setRegisteredCodes(mt_rand(1, 12));
        $company->setRegisteredPlayers(mt_rand(1, 12));
        $company->setStartDate(new \DateTime());
        $company->setTimeActive(new \DateTime('-1 day'));
        $company->setState('активный');

        $em->persist($company);
        $em->flush();

        $dql   = "SELECT a FROM AcmeGameBundle:Company a";
        $query = $em->createQuery($dql);

        $page = $request->query->getInt('page', 1);

        $paginator  = $this->get('knp_paginator');
        $tokens = $paginator->paginate(
            $query,
            $page,
            10
        );

        /*
         * Когда в коде больше комментариев, чем логики - это хорошо
         */
        $data = array(
            'items' => $tokens->getItems(),
            'count' => $tokens->getTotalItemCount(),
            'page'  => $page
        );

        /*
         * Формируем вид для нашего REST
         * Здесь будем сеарилизовывать данные
         */
        $view = $this->view($data);

        /*
         * Вся безопасность фильтрации должна выстраиваться группами
         * Для этого нужно для начала создать необходимые группы пользователей
         * И далее создать идентичные группы для сериализации
         * Далее мы просто через addGroup добавляем группу текущего пользователя по его Oatuh токену
         * И получаем только те данные, к которым он имеет доступ
         * Гибкая архитекрура, все довольны
         */
        $context = new Context();

        /*
         * Здесь будет указываться не admin, а группа пользователя
         * Что есть $this->getToken()->getUser()->getGroup()
         */
        $context->addGroup('admin');

        /*
         * Приминяем контекст админа к текущему выводу
         */
        $view->setContext($context);
        return $this->handleView($view);
    }
}
