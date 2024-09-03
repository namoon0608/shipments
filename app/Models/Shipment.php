<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table = 'shipments';
    protected $primaryKey = 'shipment_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'origin',
        'destination',
        'status',
        'cargo_details',
        'weight',
        'shipping_line_id'
    ];

    public function histories()
    {
        return $this->hasMany(ShipmentHistory::class, 'shipment_id');
    }

    public function shippingLine()
    {
        return $this->belongsTo(ShippingLine::class, 'shipping_line_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Listening to the updated event on the Shipment model
        static::updated(function ($shipment) {
            // Record the changes in the shipment_histories table
            ShipmentHistory::create([
                'shipment_id' => $shipment->shipment_id,
                'changes' => json_encode($shipment->getChanges()), // Record the changes made
            ]);
        });
    }
}