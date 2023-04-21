<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'seats',
        'status'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
