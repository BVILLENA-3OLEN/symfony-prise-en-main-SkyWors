<?php

namespace App\Controller\Post\Show;

use App\Entity\Post;
use App\Form\Type\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class PostShowGetController extends AbstractController {
	#[Route(
		path: "/post/{id}/show",
		name: "app_post_show_get",
		methods: Request::METHOD_GET
	)]

	public function __invoke(TranslatorInterface $translator, Post $post): Response {
		$form = $this->createForm(
			type: PostType::class,
			data: $post,
			options: [
				"disabled" => true
			]
		);

		$this->addFlash(
			'notice',
			'Your changes were saved'
		);

		return $this->render(
			view: "pages/post/show/post_show_form.html.twig",
			parameters: [
				"page_title" => $translator->trans(id: "app.post.show.title"),
				"form" => $form->createView()
			]
		);
	}
}
