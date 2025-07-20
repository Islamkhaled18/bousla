<?php
namespace App\Models\Admin;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    use HasFactory, HasSlug;

    protected $table   = 'join_requests';
    protected $guarded = ['id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function images()
    {
        return $this->hasMany(JoinRequestImage::class, 'join_request_id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }

        return asset('images/default.png');
    }

    public function getFrontUrlAttribute()
    {
        if ($this->id_image_front) {
            return asset('images/' . $this->id_image_front);
        }

        return asset('images/default.png');
    }

    public function getBackUrlAttribute()
    {
        if ($this->id_image_back) {
            return asset('images/' . $this->id_image_back);
        }

        return asset('images/default.png');
    }


    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('images/' . $this->logo);
        }

        return asset('images/default.png');
    }

}
