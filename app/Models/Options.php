<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $fillable = [
        'value', 'type', 'field_name', 'contact_id'
    ];

    public function contact()
    {
        return $this->belongsTo(Contacts::class);
    }
}
