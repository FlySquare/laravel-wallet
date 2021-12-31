<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    protected $table = "users";
    const CREATED_AT = 'user_created';
    const UPDATED_AT = 'user_updated';
    protected $fillable = ['user_username', 'user_password', 'user_lastlogin', 'user_lastip'];

    public function cards()
    {
        return $this->hasMany('App\Models\cards', 'card_owner', 'user_id')->orderBy('card_id','DESC');
    }
    public function contacts()
    {
        return $this->hasMany('App\Models\contacts', 'contact_owner', 'user_id');
    }
    public function monthly()
    {
        return $this->hasMany('App\Models\monthly', 'monthly_ownerid', 'user_id');
    }
    public function transactions($limit = '')
    {
        if(!empty($limit)){
            return $this->hasMany('App\Models\transactions', 'transaction_ownerid', 'user_id')
                ->take($limit)
                ->orderBy('transaction_date','DESC')
                ->get();
        }else{
            return $this->hasMany('App\Models\transactions', 'transaction_ownerid', 'user_id')
                ->orderBy('transaction_date','DESC');
        }
    }
}
