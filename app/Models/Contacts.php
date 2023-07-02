<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'last_name', 'number', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function optionValue()
    {
        return $this->hasMany(Options::class, 'contact_id');
    }
}
