<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\EmployeeFactory; 

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = ['first_name', 'last_name', 'company_id', 'email', 'phone'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected static function newFactory()
    {
        return EmployeeFactory::new();
    }
}