<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Settings;
use AppBundle\Repository\SettingsRepository;
use AppBundle\Service\GoogleSdk;
use AppBundle\Service\Pagos360Sdk;
use AppBundle\Service\SendgridSdk;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Knp\Component\Pager\Paginator as KnpPaginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class AbstractController.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
abstract class AbstractController extends Controller
{
    /**
     * @return ObjectManager
     */
    public function getEntityManager(): ObjectManager
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getDoctrine()->getManager();
    }

    /**
     * @param $class
     * @return ObjectRepository
     */
    public function getRepository($class): ObjectRepository
    {
        return $this->getDoctrine()->getManager()->getRepository($class);
    }

    /**
     * @return AuthenticationUtils
     */
    public function getAuthenticationUtilsService(): AuthenticationUtils
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('security.authentication_utils');
    }

    /**
     * @return UserPasswordEncoder
     */
    public function getPasswordEncoderService(): UserPasswordEncoder
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('security.password_encoder');
    }

    /**
     * @return KnpPaginator
     */
    protected function getKnpPaginatorService(): KnpPaginator
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('knp_paginator');
    }

    /**
     * @return SendgridSdk
     */
    protected function getSendgridSdkService(): SendgridSdk
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('app.service.sendgrid_sdk');
    }

    /**
     * @return Pagos360Sdk
     */
    protected function getPagos360SdkService(): Pagos360Sdk
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('app.service.pagos360_sdk');
    }

    /**
     * @return GoogleSdk
     */
    protected function getGoogleSdkService(): GoogleSdk
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->get('app.service.google_sdk');
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        /** @var SettingsRepository $repository */
        $repository = $this->getRepository(Settings::class);
        $siteName = $repository->findOneByCode(SettingsRepository::SITE_NAME_CODE);

        return $siteName->getValue();
    }
}
