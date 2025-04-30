<?php

namespace App\Controller\Index;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class IndexGetController extends AbstractController {
	#[Route(
		path: "/",
		name: "app_index_get",
		methods: Request::METHOD_GET
	)]

	public function __invoke(
		TranslatorInterface $translator,
		#[MapQueryParameter] ?string $name,
		PostRepository $postRepository
	): Response {
		$posts = $postRepository->getPublishedPosts();

		dump($name);
		dump($posts);

		return $this->render(
			view: "pages/index/index.html.twig",
			parameters: [
				"page_title" => $translator->trans(id: "app.index.title"),
				"name" => $translator->trans(id: "app.index.description", parameters: [
					"%name%" => $name
				]),
				"posts" => $posts
			]
		);
	}
}
