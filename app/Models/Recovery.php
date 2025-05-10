<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recovery extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'answer_1',
        'answer_2',
        'answer_3',
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
