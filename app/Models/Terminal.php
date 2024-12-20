<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Terminal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name_member', 'is_membership', 'is_vending_machine', 'is_protein_suplement', 'is_topup'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}