<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    public $timestamps   = false;
    public $incrementing = false;

    protected $fillable = ['role_id', 'permission'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
