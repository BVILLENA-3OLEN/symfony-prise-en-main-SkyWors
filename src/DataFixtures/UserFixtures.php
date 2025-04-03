<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Enum\Entity\RoleEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
	public function __construct(
		private UserPasswordHasherInterface $passwordHasher
	) {}

	public function load(ObjectManager $manager): void {
		$adminRole = new Role;
		$adminRole
			->setCode(RoleEnum::ADMIN->value)
			->setLabel("admin")
		;
		$manager->persist($adminRole);

		$userRole = new Role;
		$userRole
			->setCode(RoleEnum::USER->value)
			->setLabel("admin")
		;
		$manager->persist($userRole);

		$user = new User;
		$user
			->setEmail("a@a.com")
			->setName("admin")
			->setRole($adminRole)
			->setPassword($this->passwordHasher->hashPassword($user, "admin"))
		;
		$manager->persist($user);

		$manager->flush();
	}
}
