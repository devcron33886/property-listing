<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'amenities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'house_id',
        'parking',
        'garage',
        'building_age',
        'air_condition',
        'bedding',
        'heating',
        'internet',
        'microwave',
        'smoking_allow',
        'terrace',
        'balcony',
        'wi_fi',
        'beach',
        'property_video',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id');
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
