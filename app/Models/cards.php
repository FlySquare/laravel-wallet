<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cards extends Model
{
    use HasFactory;

    protected $primaryKey = 'card_id';
    protected $table = "cards";
    const CREATED_AT = 'card_created';
    const UPDATED_AT = 'card_updated';

    public function user()
    {
        return $this->belongsTo('user', 'user_id', 'card_owner');
    }

    public function getTotalBalanceAttribute()
    {
        return number_format( $this->card_balance,2);
    }
    public function getCardColorAttribute()
    {
       if(substr($this->card_id,-1) == 0){
            return "bg-primary";
       }elseif(substr($this->card_id,-1) == 1){
           return "bg-danger";
       }elseif(substr($this->card_id,-1) == 2){
           return "bg-secondary";
       }elseif(substr($this->card_id,-1) == 3){
           return "bg-danger";
       }elseif(substr($this->card_id,-1) == 4){
           return "bg-warning";
       }elseif(substr($this->card_id,-1) == 5){
           return "bg-info";
       }elseif(substr($this->card_id,-1) == 6){
           return "bg-muted";
       }elseif(substr($this->card_id,-1) == 7){
           return "bg-dark";
       }elseif(substr($this->card_id,-1) == 8){
           return "bg-danger";
       }elseif(substr($this->card_id,-1) == 9){
           return "bg-muted";
       }
    }
}
