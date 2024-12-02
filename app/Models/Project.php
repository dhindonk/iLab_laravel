<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'user_id', 'list_job', 'status'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }

    public function progress()
    {
        return $this->hasMany(ProjectProgress::class);
    }

    public function joinRequests()
    {
        return $this->hasMany(ProjectJoinRequest::class);
    }
}
