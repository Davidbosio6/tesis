<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Settings;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * SettingsRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 */
class SettingsRepository extends EntityRepository
{
    /**
     * This constant represents a settings code in database
     */
    const SITE_NAME_CODE = 'site_name';

    /**
     * This constant represents a settings code in database
     */
    const CONTACT_LOCATION_CODE = 'contact_location';

    /**
     * This constant represents a settings code in database
     */
    const CONTACT_PHONE_CODE = 'contact_phone';

    /**
     * This constant represents a settings code in database
     */
    const CONTACT_EMAIL_CODE = 'contact_email';

    /**
     * This constant represents a settings code in database
     */
    const CONTACT_SCHEDULE_DAYS_CODE = 'contact_schedules_days';

    /**
     * This constant represents a settings code in database
     */
    const CONTACT_SCHEDULE_HOURS_CODE = 'contact_schedules_hours';

    /**
     * @return Query
     */
    public function findAllQuery()
    {
        $qb = $this->createQueryBuilder('settings');

        return $qb->getQuery();
    }

    /**
     * @param string $code
     *
     * @return Settings|null
     */
    public function findOneByCode(string $code)
    {
        $qb = $this->createQueryBuilder('settings');
        $qb->where($qb->expr()->eq('settings.code', ':code'))->setParameter(
            'code', $code
        );

        return $qb->getQuery()->getOneOrNullResult();
    }
}