<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logged extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'action',
        'user_id',      
    ];
    
     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
  
    public function user(){
        return $this->belongsTo(User::class);
    }
}
