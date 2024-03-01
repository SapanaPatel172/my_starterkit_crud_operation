<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\ProductDataTable;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.product-management.list');
    }
    public function show(Product $product)
    {
        $this->authorize('view', $product);           
        return view('pages.apps.product-management.show')->with('product', $product);

    }
}
