<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'img_path',
        'menu_id'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
