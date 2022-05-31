<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class House extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use HasFactory;

    public const APPROVED_RADIO = [
        '0' => 'Pending',
        '1' => 'Approved',
    ];

    public const STATUS_SELECT = [
        '1' => 'For Rent',
        '2' => 'For Sale',
        '3' => 'Sold',
        '4' => 'Rented',
    ];

    public $table = 'houses';

    protected $appends = [
        'house_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'location_id',
        'property_title',
        'slug',
        'price',
        'area',
        'bedrooms',
        'bathrooms',
        'status',
        'description',
        'approved',
        'house_address',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function location()
    {
        return $this->belongsTo(Loaction::class, 'location_id');
    }

    public function getHouseImageAttribute()
    {
        $files = $this->getMedia('house_image');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
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
