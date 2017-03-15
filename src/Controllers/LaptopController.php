<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\Laptop;

class LaptopController extends AbstractController
{
    public function index(Request $request, Response $response)
    {
        $laptop = new Laptop($this->db);
        $data['laptop'] = $laptop->getAll();

        return $this->view->render($response, 'user/laptop/index.twig', $data);
    }
    public function admin(Request $request, Response $response)
    {
        $laptop = new Laptop($this->db);
        $data['laptop'] = $laptop->getAll();

        return $this->view->render($response, '/admin/index.twig', $data);
    }
    public function getAdd(Request $request, Response $response)
    {
        $laptop = new Laptop($this->db);
        $data['category'] = $laptop->getCategory();
        // return var_dump($data);

        return $this->view->render($response, '/admin/add-laptop.twig',$data);
        // $laptop = new Laptop($this->db);
        // $data['category'] = $laptop->getCategory();
    }
    public function add(Request $request, Response $response)
    {


        $laptop = new Laptop($this->db);
        $name = $request->getParams()['name'];
        $price = $request->getParams()['price'];
        $category = $request->getParams()['category'];
        $stock = $request->getParams()['stock'];
        $photo = $request->getParams()['photo'];

        $this->validation->rule('required',['name','price','stock']);
        $this->validation->rule('integer',['price','stock']);
        // $this->validation->rule('stock','integer');

        if ($this->validation->validate()) {
            $laptop->add($request->getParams());
            $_SESSION['success'] = 'Data berhasil ditambahkan';
            return $response->withRedirect($this->router->pathFor('admin'));
        } else {
            // echo $this->validation->errors() . " <a href="
            // .$this->router->pathFor('add').">Kembali</a>";
            $_SESSION['errors'] = $this->validation->errors();
            return $response->withRedirect($this->router->pathFor('add'));
        }

    }
    public function getEdit(Request $request, Response $response, $args)
    {
        $laptop = new Laptop($this->db);
        $data['laptop'] = $laptop->getById($args['id']);
        $data['category'] = $laptop->getCategory();
        // return var_dump($data);
        return $this->view->render($response, '/admin/edit-laptop.twig',$data);
    }
    public function edit(Request $request, Response $response, $args)
    {
        $laptop = new Laptop($this->db);
        $laptop->edit();
    }
    public function softDelete(Request $request, Response $response, $args)
    {
        $laptop = new Laptop($this->db);
        $laptop->softDelete($args['id']);
        return $response->withRedirect($this->router->pathFor('admin'));
    }
    public function delete(Request $request, Response $response, $args)
    {
        $laptop = new Laptop($this->db);
        $laptop->delete($args['id']);
        // return $response->withRedirect($this->router->pathFor('admin'));
    }
}
