<?php

namespace Acme\ThemeBundle\DataFixtures\FixturesTrait;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

trait UserDataTrait
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var \Acme\ThemeBundle\Util\TokenGeneratorInterface $tokenGenerator
     */
    private $tokenGenerator;

    private $savedImage = array();

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
        $this->tokenGenerator = $this->container->get('nami_core.util.token_generator');
    }

    public function createUser($username, $data)
    {
        /** @var User $user */
        $user = $this->userProvider->createUser();
        $user
            ->setActive($data['active'])
            ->setUsername($username)
            ->setPlainPassword($data['password'])
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setRoles($data['roles'])
            ->setMale($data['male'])
            ->setEmail($data['email'])
            ->setPhone($data['phone']);

        if (!array_key_exists($data['avatar'], $this->savedImage)) {
            $avatar = $this->createUserImageModel(
                'User avatar', 'avatar'
            );
            $avatar->setFilename($data['avatar']);
            $this->savedImage{$data['avatar']} = $avatar;
        }
        $user->setAvatar($this->savedImage{$data['avatar']});

        if (!$data['active']) {
            $user->setConfirmationToken(
                $this->tokenGenerator->generateToken()
            );
        }
        $this->manager->persist($user);
        $this->addReference('user_'. $username, $user);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUsers(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->userProvider = $this->container->get('nami_core.user_provider');

        $users = array(
            'admin' => array(
                'password' => 'pass',
                'active' => true,
                'firstName' => 'John',
                'lastName' => 'Doe',
                'male' => true,
                'avatar' => 'relief.png',
                'roles' => array('ROLE_ADMIN'),
                'email' => 'johndoe@host.ltd',
                'phone' => '+33123456789'
            )
        );

        foreach ($users as $username => $data) {
            $this->createUser($username, $data);
        }

        $this->manager->flush();
    }
}
