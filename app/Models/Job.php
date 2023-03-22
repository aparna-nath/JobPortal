<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
      protected $fillable=['employer_id',
            'category','title','city',
            'zipcode',            
            'company',
            'qualification',
            'description'];
}
