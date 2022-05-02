<?php

namespace App\Http\Controllers;

use App\Models\Invoice as InvoiceModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index()
    {

        $driven = InvoiceModel::where('type',\App\Enums\InvoiceType::Driven)->count();
        $unpaid = InvoiceModel::where('type',\App\Enums\InvoiceType::Unpaid)->count();
        $partially = InvoiceModel::where('type',\App\Enums\InvoiceType::Partially)->count();
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$unpaid]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$driven]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$partially]
                ],


            ])
            ->options([]);


        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$unpaid, $driven, $partially]
                ]
            ])
            ->options([]);

        return view('index', compact('chartjs', 'chartjs_2'));
    }
}
