<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class House extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use HasFactory;
    use Sluggable;

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

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 300, 300);
        $this->addMediaConversion('preview')->fit('crop', 900, 900);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function getHouseImageAttribute()
    {
        $file = $this->getMedia('house_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function sluggable(): array
    {
        return [
            'slug'=>[
                'source'=>'title'
            ]
        ];
    }
}
