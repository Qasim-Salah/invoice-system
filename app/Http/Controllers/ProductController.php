<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\Product as ProductModel;
use App\Models\Section as SectionModel;

class ProductController extends Controller
{

    public function index()
    {
        $products = ProductModel::latest()->paginate(PAGINATION_COUNT);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $sections = SectionModel::latest()->get();
        return view('products.create', compact('sections'));
    }


    public function store(ProductsRequest $request)
    {
        ProductModel::create($request->validated());

        return redirect()->route('products.index')->with(['success' => 'تمت الاضافة بنجاح']);
    }

    public function edit($id)
    {
        $sections = SectionModel::latest()->get();
        $products = ProductModel::findOrfail($id);
        return view('products.edit', compact('products', 'sections'));
    }


    public function update(ProductsRequest $request, $id)
    {
        $products = ProductModel::findOrfail($id);
        $products->update($request->validated());

        return redirect()->route('products.index')->with(['success' => 'تمت التحديث بنجاح']);
    }

    public function destroy($id)
    {
        $products = ProductModel::findOrfail($id);

        if ($products->delete()) {
            return response()->json(['error' => 'تم الحذف بنجاح']);
        }
        return response()->json(['error' => 'حدث خطا ما برجاء المحاوله لاحقا', 400]);

    }
}
