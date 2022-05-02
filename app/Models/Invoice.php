<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoices';

    protected $fillable = [
        'number',
        'date',
        'due_date',
        'product_id',
        'section_id',
        'discount',
        'value_vat',
        'rate_vat',
        'total',
        'type',
        'note',
        'user',
        'image',
        'amount_commission',
        'amount_collection',
        'payment_date',
    ];
    protected $dates = ['deleted_at'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getType()
    {
        if ($this->type == 1) {
            return 'مدفوعة';
        } elseif ($this->type == 2) {
            return 'غير مدفوعة';
        } else
            return 'مدفوعة جزئيآ ';
    }


}
