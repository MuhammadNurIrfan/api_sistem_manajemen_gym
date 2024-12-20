<?php

namespace App\Http\Controllers\api;

use App\Models\Card;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Protein_suplement;
use Illuminate\Support\Facades\Auth;
use App\Models\Topup;
use App\Models\Vending_machine;

class CardController extends Controller
{
    public function create(){
        $id = DB::table('cards')->insertGetId([
            'balance' => 0, 
        ]);
        return response()->json([ 
            'id' => $id,
            'message' => 'Berhasil'], 200);
    }

    public function list(Request $request){
        $page = $request->input('page', 0); 
        $page_size = $request->input('page_size', 10); 
        return response()->json([
            'message' => 'Berhasil',
            'cards' => Card::skip($page * $page_size)->take($page_size)->select('id')->get(),
        ], 200); 
    }

    public function topup(Request $request){ 
        $card_id = $request->input('card_id', 0); 
        $nominal = $request->input('nominal', 0); 
        if($card_id==0){
            return response()->json([
                'message' => 'CardID tidak ditemukan',
            ], 422); 
        }
        if($nominal<=0){
            return response()->json([
                'message' => 'Nominal harus positif', 
            ], 422);
        }
        $card = Card::find($card_id); 
        if($card==null){
            return response()->json([
                'message' => 'Card tidak ditemukan',
            ], 422); 
        }
        $card->balance += $nominal;
        $card->save();
        $terminal = Terminal::where('user_id', Auth::user()->id)->first(); 
        Topup::insert([
            'topup_datetime' => date('Y-m-d H:i:s'), 
            'terminal_id' => $terminal->id,
            'card_id' => $card->id,
            'nominal' => $nominal,
        ]);
        return response()->json([
        'message' => 'Top-Up berhasil',
        'saldo' => 'Rp. ' . number_format($card->balance, 0, ',', '.'), 
        ], 200);
    }

    public function membership(Request $request){ 
        $card_id = $request->input('card_id', 0); 
        $nominal = $request->input('nominal', 0);
        $paket_bulanan = $request->input('paket_bulanan', 1); // default nilainya 1 
        if($card_id==0){
            return response()->json([
                'message' => 'CardID tidak ditemukan',
            ], 422); 
        }
        if($nominal<=0){
            return response()->json([
            'message' => 'Nominal harus positif', 
            ], 422);
        }
        $card = Card::find($card_id); 
        if($card==null){
            return response()->json([
                'message' => 'Card tidak ditemukan',
            ], 422); 
        }
        if($card->balance<$nominal){ 
            return response()->json([
                'message' => 'Saldo tidak mencukupi', 
            ], 422);
        }
        $card->balance -= $nominal;
        $card->save();
        $terminal = Terminal::where('user_id', Auth::user()->id)->first(); 
        Membership::insert([
            'membership_datetime' => date('Y-m-d H:i:s'), 
            'terminal_id' => $terminal->id,
            'card_id' => $card->id,
            'nominal' => $nominal,
            'paket_bulanan' => $paket_bulanan,
        ]);
        return response()->json([
            'message' => 'Payment berhasil',
            'saldo' => 'Rp. ' . number_format($card->balance, 0, ',', '.'),
            'paket_bulanan' => $paket_bulanan . ' bulan', 
            ], 200);
    }

    public function vending_machine(Request $request){ 
        $card_id = $request->input('card_id', 0); 
        $nominal = $request->input('nominal', 0);
        $total_minuman = $request->input('total_minuman', 1); // default nilainya 1 
        if($card_id==0){
            return response()->json([
                'message' => 'CardID tidak ditemukan',
            ], 422); 
        }
        if($nominal<=0){
            return response()->json([
            'message' => 'Nominal harus positif', 
            ], 422);
        }
        $card = Card::find($card_id); 
        if($card==null){
            return response()->json([
                'message' => 'Card tidak ditemukan',
            ], 422); 
        }
        if($card->balance<$nominal){ 
            return response()->json([
                'message' => 'Saldo tidak mencukupi', 
            ], 422);
        }
        $card->balance -= $nominal;
        $card->save();
        $terminal = Terminal::where('user_id', Auth::user()->id)->first(); 
        Vending_machine::insert([
            'vending_machine_datetime' => date('Y-m-d H:i:s'), 
            'terminal_id' => $terminal->id,
            'card_id' => $card->id,
            'nominal' => $nominal,
            'total_minuman' => $total_minuman,
        ]);
        return response()->json([
            'message' => 'Payment berhasil',
            'saldo' => 'Rp. ' . number_format($card->balance, 0, ',', '.'),
            'total_minuman' => $total_minuman . ' minuman', 
            ], 200);
    }

    public function protein_suplement(Request $request){ 
        $card_id = $request->input('card_id', 0); 
        $nominal = $request->input('nominal', 0);
        $total_kapsul = $request->input('total_kapsul', 1); // default nilainya 1
 
        if($card_id==0){
            return response()->json([
                'message' => 'CardID tidak ditemukan',
            ], 422); 
        }
        if($nominal<=0){
            return response()->json([
            'message' => 'Nominal harus positif', 
            ], 422);
        }
        $card = Card::find($card_id); 
        if($card==null){
            return response()->json([
                'message' => 'Card tidak ditemukan',
            ], 422); 
        }
        if($card->balance<$nominal){ 
            return response()->json([
                'message' => 'Saldo tidak mencukupi', 
            ], 422);
        }
        $card->balance -= $nominal;
        $card->save();
        $terminal = Terminal::where('user_id', Auth::user()->id)->first(); 
        Protein_suplement::insert([
            'protein_suplement_datetime' => date('Y-m-d H:i:s'), 
            'terminal_id' => $terminal->id,
            'card_id' => $card->id,
            'nominal' => $nominal,
            'total_kapsul' => $total_kapsul,
        ]);
        return response()->json([
            'message' => 'Payment berhasil',
            'saldo' => 'Rp. ' . number_format($card->balance, 0, ',', '.'),
            'total_kapsul' => $total_kapsul . ' kapsul', 
            ], 200);
    }

    public function balance($card_id){ 
        $card = Card::find($card_id); 
        if($card==null){
            return response()->json([
                'message' => 'Card tidak ditemukan',
            ], 422); 
        }

        return response()->json([ 
            'message' => 'Berhasil', 
            'saldo' => 'Rp. ' . number_format($card->balance, 0, ',', '.'),
        ], 200); 
    } 

}