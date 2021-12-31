<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    use HasFactory;
    protected $primaryKey = 'contact_id';
    protected $table = "contacts";
    const CREATED_AT = 'contact_created';
    const UPDATED_AT = 'contact_updated';
}
