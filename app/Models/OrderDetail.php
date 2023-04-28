<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'quantity',
        'status', //0 = Đang gọi món; 1 = đã gọi món, món chưa được chế biến; 2 = món đang được chế biến; 3 = món đã được chế biến
        'note',
        'order_id',
        'item_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
