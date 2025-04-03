<?php

namespace App\Controller\HelloName;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

final class HelloNameGetController extends AbstractController {
	#[Route(
		path: '/hello/{name}',
		name: 'app_hello_name_get',
		methods: Request::METHOD_GET
	)]

	public function __invoke(
		TranslatorInterface $translator,
		string $name
	): Response {
		return $this->render(
			view: 'pages/hello/index.html.twig',
			parameters: [
				"page_title" => $translator->trans(id: "app.helloname.title"),
				"name" => $name
			]
		);
	}
}
