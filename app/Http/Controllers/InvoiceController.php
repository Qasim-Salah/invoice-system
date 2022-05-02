<?php

namespace App\Http\Controllers;


use App\Enums\InvoiceType;
use App\Http\Requests\InvoicesRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Invoice as InvoiceModel;
use App\Models\Product as ProductModel;
use App\Models\Section as SectionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = InvoiceModel::latest()->paginate(PAGINATION_COUNT);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $sections = SectionModel::latest()->get();
        $products = ProductModel::latest()->get();
        return view('invoices.create', compact('sections', 'products'));

    }

    public function store(InvoicesRequest $request)
    {

        $requests = $request->validated();

        if ($request->has('image')) {
            ###helper###
            $url = upload_image('invoices', $request->image);

            $requests['image'] = $url;
        }

        $requests['user'] = Auth::user()->name;
        $requests['date'] = Carbon::now();
        $requests['type'] = InvoiceType::Unpaid;
        InvoiceModel::create($requests);

        return redirect()->route('invoices.index')->with(['success' => 'تمت الاضافة بنجاح']);

    }

    public function show($id)
    {
        $invoice = InvoiceModel::findOrfail($id)->first();

        return view('invoices.show', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = InvoiceModel::findOrfail($id);
        $sections = SectionModel::latest()->get();
        $products = ProductModel::latest()->get();
        return view('invoices.edit', compact('invoice', 'sections', 'products'));

    }

    public function update(InvoicesRequest $request, $id)
    {
        $invoice = InvoiceModel::findOrfail($id);

        $requests = $request->validated();

        if ($request->has('image')) {
            ###helper###
            $url = upload_image('invoices', $request->image);

            $requests['image'] = $url;
        }

        $requests['date'] = Carbon::now();
        $requests['type'] = InvoiceType::Unpaid->value;

        $invoice->update($requests);

        return redirect()->route('invoices.index')->with(['success' => 'تمت التحديث بنجاح ']);

    }

    public function destroy($id)
    {
        $invoice = InvoiceModel::findOrfail($id);
        if ($invoice->forcedelete()) {

            if ($image = $invoice->image) {

                Storage::disk('public')->delete($image);//delete from folder
            }
        }
        return response()->json(['error' => 'هناك خطأ ما ', 400]);

    }

    public function edit_payment($id)
    {
        $invoice = InvoiceModel::findOrfail($id);
        $sections = SectionModel::latest()->get();
        return view('invoices.edit-payment', compact('invoice', 'sections'));

    }

    public function update_payment($id, UpdatePaymentRequest $request)
    {
        $invoice = InvoiceModel::findOrfail($id);

        $invoice->update([
            'type' => $request->type,
            'payment_date' => $request->payment_date,
        ]);

        return redirect()->route('invoices.index')->with(['success' => 'تمت التحديث بنجاح بنجاح']);

    }

    public function invoice_paid()
    {
        $invoices = InvoiceModel::where('type', InvoiceType::Driven->value)->get();

        return view('invoices.type.in-paid', compact('invoices'));
    }

    public function invoice_unpaid()
    {
        $invoices = InvoiceModel::where('type', InvoiceType::Unpaid->value)->get();

        return view('invoices.type.in-paid', compact('invoices'));
    }

    public function invoice_partial()
    {
        $invoices = InvoiceModel::where('type', InvoiceType::Partially->value)->get();

        return view('invoices.type.partial', compact('invoices'));

    }

    public function archive($id)
    {
        $invoice = InvoiceModel::findOrfail($id);

        if ($invoice->delete()) {
            return redirect()->route('invoices.archive')->with(['success' => 'تمت الارشفة بنجاح بنجاح']);
        }
        return redirect()->route('invoices.index')->with(['error' => 'هناك خطأ ما ']);

    }

    public function print($id)
    {
        $invoices = InvoiceModel::findOrfail($id);
        return view('invoices.print.print', compact('invoices'));

    }

}
