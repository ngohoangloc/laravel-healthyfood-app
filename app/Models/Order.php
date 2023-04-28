<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'order_date',
        'note',
        'status',
        'customer_id',
        'table_id'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function bill()
    {
        return $this->hasOne(Bill::class);
    }

    public function table()
    {
        return $this->hasOne(Table::class);
    }
}
