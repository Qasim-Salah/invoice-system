<?php

namespace App\Http\Controllers;

use App\Models\Invoice as InvoiceModel;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function index()
    {

        return view('reports.index');

    }

    public function search(Request $request)
    {

        $type = $request->type;
        $number = $request->number;
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);

        if ($type && $start_at == '' && $end_at == '') {

            $invoices = InvoiceModel::where('type', $type)
                ->Orwhere('number', $number)
                ->get();

            return view('reports.index', compact('invoices'));
        }

        $invoices = InvoiceModel::whereBetween('date', [$start_at, $end_at])
            ->where('type', $type)
            ->Orwhere('number', $number)
            ->get();

        return view('reports.index', compact('start_at', 'end_at', 'invoices'));

    }


}
