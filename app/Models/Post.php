<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'job_title',
        'full_description',
        'location',
        'wage',
        'working_hrs'
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
