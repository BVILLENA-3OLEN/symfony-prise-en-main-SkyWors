<?php

namespace App\Controller\Post\Create;

use App\Entity\Post;
use App\Enum\Entity\RoleEnum;
use App\Form\Type\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

class PostCreatePostController extends AbstractController {
	#[Route(
		path: "/post/create",
		name: "app_post_create_post",
		methods: Request::METHOD_POST
	)]
	#[IsGranted(RoleEnum::ADMIN->value)]

	public function __invoke(Request $request, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response {
		$newPost = new Post();

		$form = $this->createForm(
			type: PostType::class,
			data: $newPost
		);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager->persist($newPost);
			$entityManager->flush();

			return $this->redirectToRoute("app_index_get");
		}

		// return $this->render(
		// 	view: "pages/post/create/post_create_form.html.twig",
		// 	parameters: [
		// 		"page_title" => $translator->trans(id: "app.post.create.title"),
		// 		"form" => $form->createView()
		// 	]
		// );
		return $this->redirectToRoute("app_post_create_get");
	}
}
