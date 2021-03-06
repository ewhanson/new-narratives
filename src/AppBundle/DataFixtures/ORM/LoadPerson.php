<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadPerson form.
 */
class LoadPerson extends Fixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        for($i = 0; $i < 4; $i++) {
            $fixture = new Person();
            $fixture->setFullName('FullName ' . $i);
            
            $em->persist($fixture);
            $this->setReference('person.' . $i, $fixture);
        }
        
        $em->flush();
        
    }
    
}
