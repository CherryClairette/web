<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ["company_name", "contact_name", "contact_email"];

    public function posts() {
        return $this->hasMany(Post::class, 'company_id');
    } 
}
