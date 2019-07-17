<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\Program;
use App\DataFixtures\TypeFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setName('La tête dans les nuages');
        $program->setDescription('La tête dans les nuages est menée par nos deux talenteux trapézistes : Noé et Zoé. Ils vous feront voyager petits et grands lors de leur grand numéro');
        $program->setPicture('/pictures/aerial.jpg');

        $manager->getRepository(Type::class)->findOneBy(['name' => 'Voltige']);
        $program->setType($this->getReference('Voltige'));

        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TypeFixtures::class,
        );
    }
}
