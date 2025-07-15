<?php
namespace App\Models\Admin;

use App\Traits\HasImageUrl;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, HasSlug, HasImageUrl;

    protected $table   = "brands";
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(BrandImage::class, 'brand_id');
    }
}
