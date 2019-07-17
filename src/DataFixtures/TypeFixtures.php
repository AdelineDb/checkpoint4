<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    const TYPES = [
        'Voltige',
        'Jonglage',
        'Spectacle de clown',

    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TYPES as $key => $typeName) {
            $type = new Type();
            $type->setName($typeName);
            $manager->persist($type);
            $this->addReference($typeName, $type);
        }
        $manager->flush();
    }
}
