<?php

namespace App\Models;

use App\Models\Card;
use App\Models\Terminal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topup extends Model
{
    use HasFactory;

    protected $fillable = [
        'topup_datetime', 'terminal_id', 'card_id', 'nominal'
    ];

    public function terminal(){
        return $this->hasOne(Terminal::class, 'id', 'terminal_id');
    }

    public function card(){
        return $this->hasOne(Card::class, 'id', 'card_id');
    }
}
