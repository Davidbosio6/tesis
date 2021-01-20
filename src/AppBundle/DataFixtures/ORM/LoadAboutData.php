<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\About;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadAboutData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadAboutData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $about = new About();
        $about->setTittle('Misión');
        $about->setContent('Ser un centro de cuidado infantil que cumpla con los requisitos de seguridad y cuidado a sus pequeños, respaldados de un acompañamiento educativo para estos. Y comprometidos en ofrecer un buen servicio para la satisfacción de ustedes como familia.');
        $about->setShowAbout(true);
        $manager->persist($about);

        $about = new About();
        $about->setTittle('Objetivos');
        $about->setContent('Promover el desarrollo de los niños y sus capacidades, Sus pequeños no solo estarán bien cuidados, sino que al mismo tiempo recibirán estimulación temprana para empezar a desarrollar sus habilidades cognitivas, físicas, emocionales y sociales; y así llegar con una base al iniciar su educación pre-escolar.');
        $about->setShowAbout(true);
        $manager->persist($about);

        $about = new About();
        $about->setTittle('Visión');
        $about->setContent('Ser un centro de cuidado infantil y educativo de alta confiabilidad tanto para ustedes los padres,  como para la comunidad y fomentar y favorecer el desarrollo de sus niños/as');
        $about->setShowAbout(true);
        $manager->persist($about);

        $manager->flush();
    }
}
