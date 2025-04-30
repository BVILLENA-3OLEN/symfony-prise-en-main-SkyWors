<?php

namespace App\Form\Type;

use App\Entity\Post;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
				child: 'titre',
				type: TextType::class,
				options: [
					"label" => "app.form.title",
					"constraints" => [
						new NotBlank(options: [
							"message" => "app.form.title.notblank"
						]),
						new Length(max: 100)
					]
				]
			)
            ->add(
				child: 'content',
				type: TextType::class,
				options: [
					"label" => "app.form.content"
				]
			)
            ->add(
				child: 'date_create',
				type: DateTimeType::class,
				options: [
					'widget' => 'single_text',
					'label' => 'app.form.datecreate',
					"constraints" => [
						new NotNull(options: [
							"message" => "app.form.title.notnull"
						]),
						new GreaterThan(value: new DateTime(datetime: "-1 month"))
					]
				]
			)
            ->add(
				child: 'author',
				type: TextType::class,
				options: [
					"label" => "app.form.author",
					"constraints" => [
						new NotBlank(options: [
							"message" => "app.form.title.notblank"
						]),
						new Length(max: 255)
					]
				]
			)
		;

		if (!$builder->getDisabled()) {
			$builder->add(
				child: 'submit',
				type: SubmitType::class,
				options: [
					"label" => "Oui",
					"attr" => [
						"class" => "btn btn-primary"
					]
				]
			);
		}
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
			'translation_domain' => false,
        ]);
    }
}
