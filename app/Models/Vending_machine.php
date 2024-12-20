<?php

namespace App\Models;

use App\Models\Card;
use App\Models\Terminal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vending_machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'vending_machine_datetime', 'terminal_id', 'card_id', 'nominal', 'total_minuman'
    ];

    public function terminal(){
        return $this->hasOne(Terminal::class, 'id', 'terminal_id');
    }

    public function card(){
        return $this->hasOne(Card::class, 'id', 'card_id');
    }
}
