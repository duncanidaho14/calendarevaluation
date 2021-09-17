<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Commercial;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\RendezVous;
use DateTime;

class AppFixtures extends Fixture
{
    public $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('Elhadi')
            ->setLastName('Beddarem')
            ->setEmail('elhadibeddarem@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setPhone('0606060606')
        ;
        $manager->persist($user);

        $user2 = new User();
        $user2->setFirstName('Zinedine')
            ->setLastName('Zidane')
            ->setEmail('zz@gmail.com')
            ->setPassword($this->encoder->encodePassword($user2, 'password'))
            ->setPhone('0707070707')
        ;
        $manager->persist($user2);

        $user3 = new User();
        $user3->setFirstName('Ronaldinho')
            ->setLastName('Gaucho')
            ->setEmail('ronaldinho@gmail.com')
            ->setPassword($this->encoder->encodePassword($user3, 'password'))
            ->setPhone('0808080808')
        ;
        $manager->persist($user3);

        $commercial = new Commercial();
        $commercial->setFirstName('François')
                    ->setLastName('Pignon')
                    ->setPhone('0123456789')
                    ->setEmail('francois.pignon@dinner.con')
        ;
        $manager->persist($commercial);

        $commercial2 = new Commercial();
        $commercial2->setFirstName('Juste')
                    ->setLastName('Leblanc')
                    ->setPhone('987654312')
                    ->setEmail('juste.leblanc@dinner.con')
        ;
        $manager->persist($commercial2);

        $commercial3 = new Commercial();
        $commercial3->setFirstName('Marlène')
                    ->setLastName('Sassoeur,')
                    ->setPhone('346789654')
                    ->setEmail('marlene.sassoeur@dinner.con')
        ;
        $manager->persist($commercial3);

        
        $rdv = new RendezVous();
        $rdv->setName('crampons')
            ->setDate((new DateTime('now')))
            ->setDateEnd((new DateTime('+3 hours')))
            ->setCommercial($commercial)
            ->setUser($user2)
        ;
        $manager->persist($rdv);
        

        $rdv2 = new RendezVous();
        $rdv2->setName('tibias')
            ->setDate((new DateTime('tomorrow')))
            ->setDateEnd((new Datetime('tomorrow +3 hours')))
            ->setCommercial($commercial2)
            ->setUser($user)
        ;
        $manager->persist($rdv2);

        $rdv3 = new RendezVous();
        $rdv3->setName('genoux')
            ->setDate((new DateTime('now')))
            ->setDateEnd((new Datetime('+5 hours')))
            ->setCommercial($commercial3)
            ->setUser($user)
        ;
        $manager->persist($rdv3);

        $manager->flush();
    }
}
