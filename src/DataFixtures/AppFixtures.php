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
            ->setImageName('gettyimages-1401741294-0-652bbb75c16ac366314578.jpg')
            ->setDescription('Bella je úžasný psík plný pozitívnej energie a lásky k životu! Jej hravosť a zvedavosť svedčia o tom, že má veľký záujem o svet okolo seba. Táto vlastnosť môže byť skvelou motiváciou pre spoločné aktivity a trávenie času s ňou.

Jej láskavosť a túžba po maznaní sú nádherné vlastnosti, ktoré môžu vytvoriť hlboké puto medzi vami a ňou. Rada vám bude spoločníčiť a poskytovať vám veľa radosti a oddychu po náročných dňoch.

Jej spoločenskosť a radosť zo hry s inými psami ju robia ideálnym spoločníkom aj pre iných štvornohých kamarátov. To môže poskytnúť veľa príležitostí na sociálny kontakt a zábavu.

Jej inteligencia a schopnosť rýchlo sa učiť z nej robia psa, s ktorým môžete vytvárať hlbšie puto. Máte príležitosť využiť túto inteligenciu na tréning a spoločné aktivity, ktoré budú zábavné a obohacujúce pre vás obidvoch.

Pre rodinu s deťmi je Bella skvelou voľbou. Jej priateľský a láskavý charakter môže vytvoriť silné puto medzi ňou a deťmi, a tým prispieť k pozitívnej atmosfére v domácnosti.

Celkovo ide o skvelého spoločníka, ktorý prináša radosť a lásku do svojho okolia. S láskavým prístupom a správnou starostlivosťou bude Bella pravdepodobne vašou vernou priateľkou na mnoho šťastných rokov.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Thor')
            ->setGender('male')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2021-05-02'))
            ->setImageName('animalcenteroctober2022-40-652bbb7cc0411667378450.jpg')
            ->setDescription('Thor znie ako úžasný spoločník plný energie a zvedavosti! Jeho hravosť a záujem o okolitý svet ho robia skvelým partnerom pre aktívnych ľudí, ktorí radi trávia čas so psom vonku.

Jeho láskavosť a chuť k maznaniu sú neoceniteľné vlastnosti. Tieto prejavy náklonnosti vám môžu priniesť nielen radosť, ale aj pokoj a pohodu v každodennom živote. Jeho prítomnosť môže byť skutočným zdrojom radosti a šťastia.

Jeho spoločenský charakter a radosť zo hry s inými psami svedčia o tom, že je skvelým tímovým hráčom. To môže byť výborná príležitosť pre sociálne interakcie s inými majiteľmi psov a ich štvornohými priateľmi.

Jeho inteligencia a schopnosť rýchlo sa učiť ho robia výborným kandidátom na rôzne tréningové aktivity. Máte možnosť spolu vytvárať hlbšie puto a rozvíjať jeho schopnosti. Môže sa to týkať poslušnosti, trikov alebo dokonca rôznych športových aktivít.

Pre rodiny s deťmi je Thor ideálnym spoločníkom. Jeho priateľská povaha a schopnosť dobre sa vychádzať s deťmi môžu prispieť k pozitívnej atmosfére v domácnosti. Bude verným kamarátom a možno aj ochranníkom vašich detí.

Celkovo ide o výnimočného psa, ktorý môže príniesť veľa radosti a lásky do vášho života. S láskavým a trpezlivým prístupom budete mať v Thorovi verného a oddaného priateľa, s ktorým budete mať spoločné nezabudnuteľné chvíle.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Joško')
            ->setGender('male')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2021-05-02'))
            ->setImageName('istock-11799314-story-stock-652bbb8453c61808164927.jpg')
            ->setDescription('Joško je úžasný spoločník plný energie a zvedavosti! Jeho hravosť a záujem o okolitý svet ho robia skvelým partnerom pre aktívnych ľudí, ktorí radi trávia čas so psom vonku.

Jeho láskavosť a chuť k maznaniu sú neoceniteľné vlastnosti. Tieto prejavy náklonnosti vám môžu priniesť nielen radosť, ale aj pokoj a pohodu v každodennom živote. Jeho prítomnosť môže byť skutočným zdrojom radosti a šťastia.

Jeho spoločenský charakter a radosť zo hry s inými psami svedčia o tom, že je skvelým tímovým hráčom. To môže byť výborná príležitosť pre sociálne interakcie s inými majiteľmi psov a ich štvornohými priateľmi.

Jeho inteligencia a schopnosť rýchlo sa učiť ho robia výborným kandidátom na rôzne tréningové aktivity. Máte možnosť spolu vytvárať hlbšie puto a rozvíjať jeho schopnosti. Môže sa to týkať poslušnosti, trikov alebo dokonca rôznych športových aktivít.

Pre rodiny s deťmi je Joško ideálnym spoločníkom. Jeho priateľská povaha a schopnosť dobre sa vychádzať s deťmi môžu prispieť k pozitívnej atmosfére v domácnosti. Bude verným kamarátom a možno aj ochranníkom vašich detí.

Celkovo ide o výnimočného psa, ktorý môže príniesť veľa radosti a lásky do vášho života. S láskavým a trpezlivým prístupom budete mať v Joškoovi verného a oddaného priateľa, s ktorým budete mať spoločné nezabudnuteľné chvíle.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Ivetka')
            ->setGender('female')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2019-02-05'))
            ->setImageName('volunteer-at-animal-shelter-1-652bbb8bdf541803065655.jpg')
            ->setDescription('Ivetka je hravá sučka s veľkým záujmom o všetko, čo sa deje okolo nej. Je veľmi milá a rada sa mazlí. Je veľmi spoločenská a rada sa hrá s inými psami. Je veľmi inteligentná a rýchlo sa učí. Je vhodná aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Maroško')
            ->setGender('male')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2021-05-02'))
            ->setImageName('d47d90-1fc568a4651247dc836baeffeeca576f-mv2-652bbb95b3e16566854609.webp')
            ->setDescription('Maroško je hravý pes s veľkým záujmom o všetko, čo sa deje okolo neho. Je veľmi milý a rád sa mazlí. Je veľmi spoločenský a rád sa hrá s inými psami. Je veľmi inteligentný a rýchlo sa učí. Je vhodný aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Nella')
            ->setGender('female')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2019-02-05'))
            ->setImageName('images-3-652bbb9e0b3ca703725604.jpg')
            ->setDescription('Nella je hravá sučka s veľkým záujmom o všetko, čo sa deje okolo nej. Je veľmi milá a rada sa mazlí. Je veľmi spoločenská a rada sa hrá s inými psami. Je veľmi inteligentná a rýchlo sa učí. Je vhodná aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Kali')
            ->setGender('male')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2021-05-02'))
            ->setImageName('gettyimages-1401741294-0-652bbb75c16ac366314578.jpg')
            ->setDescription('Kali je hravý pes s veľkým záujmom o všetko, čo sa deje okolo neho. Je veľmi milý a rád sa mazlí. Je veľmi spoločenský a rád sa hrá s inými psami. Je veľmi inteligentný a rýchlo sa učí. Je vhodný aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Lila')
            ->setGender('female')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2019-02-05'))
            ->setImageName('animalcenteroctober2022-40-652bbb7cc0411667378450.jpg')
            ->setDescription('Lila je hravá sučka s veľkým záujmom o všetko, čo sa deje okolo nej. Je veľmi milá a rada sa mazlí. Je veľmi spoločenská a rada sa hrá s inými psami. Je veľmi inteligentná a rýchlo sa učí. Je vhodná aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Lenny')
            ->setGender('male')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2021-05-02'))
            ->setImageName('istock-11799314-story-stock-652bbb8453c61808164927.jpg')
            ->setDescription('Lenny je hravý pes s veľkým záujmom o všetko, čo sa deje okolo neho. Je veľmi milý a rád sa mazlí. Je veľmi spoločenský a rád sa hrá s inými psami. Je veľmi inteligentný a rýchlo sa učí. Je vhodný aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Christy')
            ->setGender('female')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2019-02-05'))
            ->setImageName('volunteer-at-animal-shelter-1-652bbb8bdf541803065655.jpg')
            ->setDescription('Christy je hravá sučka s veľkým záujmom o všetko, čo sa deje okolo nej. Je veľmi milá a rada sa mazlí. Je veľmi spoločenská a rada sa hrá s inými psami. Je veľmi inteligentná a rýchlo sa učí. Je vhodná aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Chris')
            ->setGender('male')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2021-05-02'))
            ->setImageName('d47d90-1fc568a4651247dc836baeffeeca576f-mv2-652bbb95b3e16566854609.webp')
            ->setDescription('Chris je hravý pes s veľkým záujmom o všetko, čo sa deje okolo neho. Je veľmi milý a rád sa mazlí. Je veľmi spoločenský a rád sa hrá s inými psami. Je veľmi inteligentný a rýchlo sa učí. Je vhodný aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $pet = (new Pet())
            ->setName('Tina')
            ->setGender('female')
            ->setType('dog')
            ->setSize('small')
            ->setDateOfBirth(new \DateTime('2019-02-05'))
            ->setImageName('images-3-652bbb9e0b3ca703725604.jpg')
            ->setDescription('Tina je hravá sučka s veľkým záujmom o všetko, čo sa deje okolo nej. Je veľmi milá a rada sa mazlí. Je veľmi spoločenská a rada sa hrá s inými psami. Je veľmi inteligentná a rýchlo sa učí. Je vhodná aj do rodiny s deťmi.')
            ->setTemplate($template);
        $manager->persist($pet);

        $manager->flush();
    }
}
