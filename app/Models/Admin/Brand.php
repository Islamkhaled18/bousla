<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//slug
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;
    protected $table   = "brands";
    protected $guarded = ['id'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }
        return asset('images/default.png');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // BOOT SLUG
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function images()
    {
        return $this->hasMany(BrandImage::class, 'brand_id');
    }
}
