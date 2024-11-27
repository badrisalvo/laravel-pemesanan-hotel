<?php

namespace App\Http\Controllers;

use App\Models\About; // Pastikan model About diimport
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $about = About::find(1);// Mengambil data pertama dari tabel about
        $recentRooms = Room::latest()->take(5)->get(); // Mengambil 5 kamar terbaru
        return view('home', compact('about', 'recentRooms')); // Mengirimkan data ke view
    }
    
}

