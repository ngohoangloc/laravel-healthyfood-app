<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menus';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
