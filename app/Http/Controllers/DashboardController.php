<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Skema;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Jika yang login adalah admin
        if ($user->role == 'admin') {
            $total_peserta = Peserta::count();
            $total_skema = Skema::count();
            $peserta_terbaru = Peserta::with('skema')->latest()->take(5)->get();

            return view('dashboard', compact('total_peserta', 'total_skema', 'peserta_terbaru'));
        } 
        
        // Jika yang login adalah user biasa
        else {
            // Ambil data peserta yang emailnya cocok dengan user yang sedang login
            $peserta = Peserta::with('skema')->where('email', $user->email)->first();

            return view('user.dashboard-user', compact('peserta'));
        }
    }
}