<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $guarded = [];
    protected $fillable = ['name','contact_no','designation', 'profile', 'department', 'job_type', 'email', 'joining_date', 'status', 'attendance'];

    protected $casts = [
        'attendance' => 'array',
      
        ];

        public function user()
        {
            return $this->hasOne(User::class, 'email', 'email');
        }
}

