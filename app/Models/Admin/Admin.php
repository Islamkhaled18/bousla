<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
//slug
use Illuminate\Support\Str;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guard   = 'admin';
    protected $guarded = ['id'];
    protected $table   = 'admins';

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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // relations
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
