<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role','mobile','address'
    ];

    public function isAdmin(){
        return $this->role === 'admin';

    }

    public function isCustomer(){
        return $this->role === 'customer';
    }

    public function rentals(){
        return $this->hasMany(Rental::class);
    }

    public function setMobileDefault($value)
    {
        $this->attributes['mobile'] = $value ? $value : 'N/A';
    }

    public function setAddressDefault($value)
    {
        $this->attributes['address'] = $value ? $value : 'N/A';
    }

}
