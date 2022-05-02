<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionsRequest;
use App\Models\Section as SectionModel;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{

    public function index()
    {
        $sections = SectionModel::latest()->paginate(PAGINATION_COUNT);
        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        return view('sections.create');
    }

    public function store(SectionsRequest $request)
    {
        $requests = $request->validated();
        $requests['created_by'] = Auth::user()->name;

        SectionModel::create($requests);

        return redirect()->route('sections.index')->with(['success' => 'تمت الاضافة بنجاح']);

    }

    public function edit($id)
    {
        $sections = SectionModel::findOrfail($id);
        return view('sections.edit', compact('sections'));
    }

    public function update(SectionsRequest $request, $id)
    {
        $sections = SectionModel::findOrfail($id);
        $requests = $request->validated();
        $sections->update($requests);

        return redirect()->route('sections.index')->with(['success' => 'تم التحديث بنجاح']);

    }

    public function destroy($id)
    {
        $sections = SectionModel::findOrfail($id);

        if (empty($sections->product->count())) {
            $sections->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        }

        return response()->json(['error' => 'حدث خطا ما برجاء المحاوله لاحقا', 400]);

    }
}
