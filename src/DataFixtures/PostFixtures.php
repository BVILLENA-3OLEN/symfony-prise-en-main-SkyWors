<?php

namespace App\DataFixtures;

use App\Entity\Post;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
	public function load(ObjectManager $manager): void {
		$faker = Factory::create(locale: "fr_FR");

		for ($i = 0; $i < 20; $i++) {
			$post = new Post();
			$post
				->setTitre(titre: $faker->realTextBetween(minNbChars: 10, maxNbChars: 50))
				->setAuthor(author: $faker->name() . " " . $faker->lastName())
				->setContent(content: $faker->text(maxNbChars: 200))
				->setDateCreate(date_create: DateTimeImmutable::createFromMutable($faker->dateTimeBetween(startDate: '-1 year', endDate: 'now')));

			$manager->persist(object: $post);
		}

		$manager->flush();
	}
}
