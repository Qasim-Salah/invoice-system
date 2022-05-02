<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product as ProductModel;


class InvoiceController extends Controller
{
    public function find($id)
    {
        $product = ProductModel::where('section_id', $id)->get();

        return response()->json($product);
    }


}
