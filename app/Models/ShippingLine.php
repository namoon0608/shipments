<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingLine extends Model
{
    use HasFactory;

    protected $table = 'shipping_lines';
    protected $primaryKey = 'shipping_line_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
    ];

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'shipping_line_id');
    }
}