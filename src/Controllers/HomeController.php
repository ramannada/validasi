<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controller\AbstractModel;
use App\Models\Home;

class HomeController extends AbstractController
{
    public function index(Request $request, Response $response)
    {
        return $this->view->render($response, '/user/home/index.twig');
    }
}
