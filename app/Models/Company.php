<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\CompanyFactory;

//Company Model
class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'logo', 'website'];

    //Relationship with Employees
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    //runs factory
    protected static function newFactory()
    {
        return CompanyFactory::new();
    }
}