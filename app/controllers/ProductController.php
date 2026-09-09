<?php

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $this->view('productos/index', [
            'products' => $products,
            'title' => 'Vangwear',
        ]);
    }
}
