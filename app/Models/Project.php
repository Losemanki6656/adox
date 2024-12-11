<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use CrudTrait, SoftDeletes, CascadeSoftDeletes;


    protected $cascadeDeletes = ['details'];

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'projects';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function details(): HasMany
    {
        return $this->hasMany(ProjectDetail::class, 'project_id');
    }

    public function drawings(): HasMany
    {
        return $this->hasMany(Drawing::class, 'project_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = str_replace(['(', ')', '-', ' '], '', $value);
    }
}
