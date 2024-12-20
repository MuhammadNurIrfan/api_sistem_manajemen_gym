<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TerminalController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users'], 
            'name_member' => ['required', 'string', 'max:255'], 
            'is_membership' => ['required', 'boolean'],
            'is_vending_machine' => ['required', 'boolean'],
            'is_protein_suplement' => ['required', 'boolean'],
            'is_topup' => ['required', 'boolean'],
        ]);
        $email = $request->email;
        $is_membership = $request->get('is_membership', 0); 
        $is_vending_machine = $request->get('is_vending_machine', 0);
        $is_protein_suplement = $request->get('is_protein_suplement', 0); 
        $is_topup = $request->get('is_topup', 0); 
        if($is_membership==0 && $is_vending_machine==0 && $is_protein_suplement==0 && $is_topup==0){
            return response()->json([
                'message' => 'Is_membership, Is_vending_machine, Is_protein_suplement, Is_topup tidak boleh 0'], 422);
        }
        if($is_membership==1 && $is_vending_machine==1 && $is_protein_suplement==1 && $is_topup==1){
            return response()->json([
                'message' => 'Is_membership, Is_vending_machine, Is_protein_suplement, Is_topup tidak boleh 1'], 422);
        }
        $user = User::where('email', $email)->first();
        $terminal = Terminal::where('user_id', $user->id)->first(); if($terminal!=null){
        return response()->json([
        'message' => 'Email sudah dipakai di terminal lain'], 422);
        }
        DB::table('terminals')->insert([
            'user_id' => $user->id, 
            'name_member' => $request->name_member, 
            'is_membership' => $is_membership, 
            'is_vending_machine' => $is_vending_machine,
            'is_protein_suplement' => $is_protein_suplement,
            'is_topup' => $is_topup,
        ]);
        return response()->json(['message' => 'Berhasil'], 200);
    }

    public function list(Request $request){
        $page = $request->input('page', 0); 
        $page_size = $request->input('page_size', 10); 
        return response()->json([
            'message' => 'Berhasil',
            'terminals' => Terminal::skip($page * $page_size)->take($page_size)->get(), 
        ], 200);
    }
}
