<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'priority'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function getCreatedAtAttribute($value) {
        $date = new Carbon($value);
        return $date->toDayDateTimeString();
    }
}
