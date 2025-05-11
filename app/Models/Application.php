<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'partylist_id',
        'user_id',
        'candidate_id',
        'position_id',
        'status',
        
    ];
    
     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
     public function partylist(){
        return $this->belongsTo(Partylist::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function candidate(){
        return $this->belongsTo(Candidate::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }
}
