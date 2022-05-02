<?php

namespace App\Http\Controllers;

use App\Models\Invoice as InvoiceModel;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{

    public function index()
    {

        $invoices = InvoiceModel::onlyTrashed()->get();
        return view('invoices.archive.archive', compact('invoices'));
    }

    public function update($id)
    {


        $invoice = InvoiceModel::withTrashed()->findOrfail($id)->restore();

        return redirect()->route('invoices.index')->with(['success' => ' تمت الغاء الارشفة بنجاح']);

    }

    public function destroy($id)
    {


        $invoice = InvoiceModel::withTrashed()->findOrfail($id);

        if ($invoice->forcedelete()) {

            if ($image = $invoice->image) {

                Storage::disk('public')->delete(str_replace($image, url('/'), ''));//delete from folder
            }
        }
        return response()->json(['error' => 'هناك خطأ ما ', 400]);
    }

}
