<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'information';
    public function Information()
    {
        return $this->belongsTo(User::class,'Card_id');
    }
    public $timestamps = false;
    protected $fillable = [
        'Name',
        'Card_id',
        'Picture',
        'Date_of_birth',
        'Gender' ,
        'Address' ,
        'Relationship_statues',
        'Family_history' ,
        'Immunizations',
        'Allergies',
        'Surgeries',
        'Drugs_prescribed',
        'Blood_type' ,
        'Doctor_visits',
        'Disease',
        
    ];
}
