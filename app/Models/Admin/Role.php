<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//slug
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    = 'roles';
    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
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

}
