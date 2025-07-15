<?php
namespace App\Models\Admin;

use App\Traits\HasImageUrl;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory, HasSlug, HasImageUrl;

    protected $table   = "ads";
    protected $guarded = ['id'];

    // RELATIONSHIPS
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
