<?php
namespace App\Models\Admin;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

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

}
