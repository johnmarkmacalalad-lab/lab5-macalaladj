<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Products extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('Product_model');

        if (!$this->session->has_userdata('user')) {
            redirect('/login');
            exit;
        }
    }

    public function index()
    {
        $this->call->view('products/index', [
            'products' => $this->Product_model->all_products(),
            'user' => $this->session->userdata('user'),
        ]);
    }

    public function create()
    {
        $this->call->view('products/form', ['product' => null, 'form_action' => '/products/create']);
    }

    public function store()
    {
        $this->Product_model->create_product($this->validated_input());
        redirect('/products');
        exit;
    }

    public function edit($id)
    {
        $product = $this->Product_model->find_product($id);
        if (!$product) {
            show_404();
        }
        $this->call->view('products/form', ['product' => $product, 'form_action' => '/products/edit/' . (int) $id]);
    }

    public function update($id)
    {
        $this->Product_model->update_product($id, $this->validated_input());
        redirect('/products');
        exit;
    }

    public function delete($id)
    {
        $this->Product_model->delete_product($id);
        redirect('/products');
        exit;
    }

    private function validated_input()
    {
        return [
            'product_name' => trim((string) ($_POST['product_name'] ?? '')),
            'description' => trim((string) ($_POST['description'] ?? '')),
            'price' => number_format((float) ($_POST['price'] ?? 0), 2, '.', ''),
            'quantity' => max(0, (int) ($_POST['quantity'] ?? 0)),
        ];
    }
}