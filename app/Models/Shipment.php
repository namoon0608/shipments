<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table = 'shipments';
    protected $primaryKey = 'shipments_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'origin',
        'destination',
        'status',
        'cargo_details',
        'weight',
    ];

    public function status() {
        return $this->belongsTo(Status::class, 'status', 'status');
    }
}