<?php

namespace App\Controller\Post\Create;

use App\Enum\Entity\RoleEnum;
use App\Form\Type\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

class PostCreateGetController extends AbstractController {
	#[Route(
		path: "/post/create",
		name: "app_post_create_get",
		methods: Request::METHOD_GET
	)]
	#[IsGranted(RoleEnum::ADMIN->value)]

	public function __invoke(
		TranslatorInterface $translator
	): Response {
		$form = $this->createForm(
			type: PostType::class
		);

		return $this->render(
			view: "pages/post/create/post_create_form.html.twig",
			parameters: [
				"page_title" => $translator->trans(id: "app.post.create.title"),
				"form" => $form->createView()
			]
		);
	}
}
