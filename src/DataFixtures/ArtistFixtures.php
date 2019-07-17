<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $artist = new Artist();

        $artist->setName('Marco le Rigolo');
        $artist->setBiography('Marco est un clown rigolo. Même s\'il tire sa filiation de personnages grotesques anciens, notamment ceux de la Commedia dell\'arte, le clown proprement dit est une création relativement récente. Il apparaît pour la première fois en Angleterre au xviiie siècle, dans les cirques équestres. Les directeurs de ces établissements, afin d\'étoffer leurs programmes, engagèrent des garçons de ferme qui ne savaient pas monter à cheval pour entrecouper les performances des véritables cavaliers. Installés dans un rôle de serviteur benêt, ils faisaient rire autant par leurs costumes de paysans, aux côtés des habits de lumière des autres artistes, que par les postures comiques qu\'ils adoptaient, parfois à leurs dépens. 
        Les clowns suivaient le mouvement des numéros présentés, en les caricaturant pour faire rire (le clown sauteur, le clown acrobate…). Ce personnage évolua pour devenir de moins en moins comique : distingué, adoptant des vêtements aux tissus nobles et de plus en plus lourds avec l\'emploi des paillettes, il fit équipe avec l\'auguste. Ce dernier devint le personnage comique par excellence, le clown servant de faire-valoir. C\'est la configuration que l\'on connaît aujourd\'hui. L\'auguste prit peu à peu son autonomie, quand certains trouvèrent le moyen de faire rire la salle sans avoir besoin du clown pailleté. L\'auguste s\'imposa alors en tant qu\'artiste solitaire, proposant parfois à un spectateur de lui servir de partenaire.
        Le clown peut porter un pseudonyme inspiré du langage enfantin (en langue française, l\'utilisation du redoublement de syllabe ou de sons est ainsi courant), comme Jojo, Kiki, etc.');

        $artist->setPicture('/pictures/clown.jpg');

        $manager->persist($artist);

        $manager->flush();
    }
}
