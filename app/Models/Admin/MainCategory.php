<?php
namespace App\Models\Admin;

use App\Traits\HasImageUrl;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory, HasSlug, HasImageUrl;

    protected $table   = "main_categories";
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->hasMany(Category::class, 'main_category_id');
    }
}
