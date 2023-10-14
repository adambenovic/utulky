<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Attribute;
use App\Entity\Pet;
use App\Entity\Template;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $address = (new Address())
            ->setIsMain(true)
            ->setStreet('Hlavná')
            ->setStreetNumber('1')
            ->setCity('Žilina')
            ->setZipCode('01001');
        $manager->persist($address);

        $user = (new User())
            ->setEmail('jozef.mrkvicka@gmail.com')
            ->setName('Jozef')
            ->setSurname('Mrkvička')
            ->setPhone('+421911123456')
            ->setDateOfBirth(new \DateTime('1996-10-07'))
            ->addAddress($address)
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$Z0Z6Z0Z6Z0Z6Z0Z6Z0Z6Zw$+0');
        $manager->persist($user);

        $shelter = (new User())
            ->setEmail('ozutulacik@gmail.com')
            ->setShelter('Ozutulacik')
            ->setPhone('+421911123456')
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$Z0Z6Z0Z6Z0Z6Z0Z6Z0Z6Zw$+0');
        $manager->persist($shelter);

        $template = (new Template())
            ->setName('Dog adoption form')
            ->setOwner($shelter);
        $manager->persist($template);

        $attribute = (new Attribute())
            ->setName('PREČO STE SA ROZHODLI ADOPTOVAŤ TOTO KONKRÉTNE ZVIERA?')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('PRE AKÝ ÚČEL SI ZAOBSTARÁVATE ZVIERA (STRÁŽENIE, SPOLOČNÍK ...)?')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Kde bývate?')
            ->setType('string')
            ->setRequired(true)
            ->setChoices([
                'Byt',
                'Dom'
            ])
            ->setExpectedValue('Dom')
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Na ktorom poschodí bývate?')
            ->setType('integer')
            ->setRequired(false)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Máte výťah?')
            ->setType('string')
            ->setRequired(false)
            ->setChoices([
                'Áno',
                'Nie'
            ])
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Typ bývania')
            ->setType('string')
            ->setRequired(true)
            ->setChoices([
                'Nájomné',
                'Vlastné'
            ])
            ->setExpectedValue('Vlastné')
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Poloha bývania')
            ->setType('string')
            ->setRequired(true)
            ->setChoices([
                'Vidiek',
                'Centrum mesta',
                'Okraj mesta',
                'Sídlisko'
            ])
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Popis bezprostredného okolia pri dome (ulice, polia, les a pod.):')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Počet osôb v domácnosti')
            ->setType('integer')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Z toho deti')
            ->setType('integer')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Vek detí')
            ->setType('string')
            ->setRequired(false)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Súhlasia všetci členovia rodiny/domácnosti s adopciou psa?')
            ->setType('string')
            ->setRequired(true)
            ->setChoices([
                'Áno',
                'Nie'
            ])
            ->setExpectedValue('Áno')
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Mal uchádzač v minulosti domáce zviera?')
            ->setType('string')
            ->setRequired(true)
            ->setChoices([
                'Áno',
                'Nie'
            ])
            ->setExpectedValue('Áno')
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Ak áno, stalo sa s nimi nasledovné:')
            ->setType('text')
            ->setRequired(false)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Iné zvieratá v domácnosti(druh, vek, kastrovaný):')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Za akých okolností by ste vrátili zviera späť z adopcie?')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Ak sa v budúcnosti presťahujete, čo bude so zvieraťom?')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Je Vám známe, že zabývanie sa zvieraťa z útulku môže trvať aj niekoľko týždňov/mesiacov?')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Do akej miery ste ako človek resp. rodina aktívny?')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $attribute = (new Attribute())
            ->setName('Kto sa bude starať o psa v prípade Vašej neprítomnosti, ochorenia, dovolenky apod.?')
            ->setType('text')
            ->setRequired(true)
            ->addTemplate($template);
        $manager->persist($attribute);

        $pet = (new Pet())
            ->setName('Bella')
            ->setGender('female')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2019-02-05'))
            ->setDescription('Bella je hravá sučka s veľkým záujmom o všetko, čo sa deje okolo nej. Je veľmi milá a rada sa mazlí. Je veľmi spoločenská a rada sa hrá s inými psami. Je veľmi inteligentná a rýchlo sa učí. Je vhodná aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Thor')
            ->setGender('male')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2021-05-02'))
            ->setDescription('Thor je hravý pes s veľkým záujmom o všetko, čo sa deje okolo neho. Je veľmi milý a rád sa mazlí. Je veľmi spoločenský a rád sa hrá s inými psami. Je veľmi inteligentný a rýchlo sa učí. Je vhodný aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);



        $manager->flush();
    }
}
