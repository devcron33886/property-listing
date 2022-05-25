<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleInfo extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public const TRANSMISSION_SELECT = [
        '1' => 'Automatic',
        '2' => 'Manual',
    ];

    public const FUEL_SELECT = [
        '1' => 'Diesel',
        '2' => 'Essence',
        '3' => 'Electric',
    ];

    public $table = 'vehicle_infos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'car_id',
        'fuel',
        'steeling',
        'air_bag',
        'transmission',
        'audio_input',
        'bluetooth',
        'heated_seats',
        'fm_radio',
        'usb_input',
        'gps_navigation',
        'sunroof',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
