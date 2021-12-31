<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    use HasFactory;
    protected $primaryKey = 'transaction_id ';
    protected $table = "transactions";
    const CREATED_AT = 'transaction_date';
    const UPDATED_AT = 'transaction_update';
}
