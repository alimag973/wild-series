<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMLIST = [['title' => 'Friends', 'synopsis'=> 'Les péripéties de 6 amis New-yorkais', 'category'=> 'category_Comédie'],
     ['title'=> 'Orphanblack', 'synopsis' =>'une orpheline découvre l existence de plusieurs sosies', 'category'=> 'category_Action'],
     ['title'=> 'American Horror Story', 'synopsis'=> 'récits poignants et cauchemardesques', 'category'=> 'category_Horreur'],
     ['title'=> 'The Shield', 'synopsis'=> 'Equipe de policier de los angeles aux méthodes peu orthodoxes', 'category'=> 'category_Action'],
     [ 'title'=> 'Stranger things', 'synopsis'=> 'Quand un jeune garçon disparaît, une petite ville découvre une affaire mystèrieuse', 'category'=> 'category_Fantastique']];
    
     public static int $mavariable = 0;
    
     public function load(ObjectManager $manager)
    {
        foreach(self::PROGRAMLIST as $key => $programName) {
           $program = new Program();
           $program-> settitle($programName['title']);
           $program-> setsynopsis($programName['synopsis']);
           $program-> setcategory($this->getReference($programName['category']));
           $manager->persist($program);
           $this->addReference('program_' . $key, $program);
           self::$mavariable++;

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }


}