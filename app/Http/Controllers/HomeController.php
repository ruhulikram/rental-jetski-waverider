<?php

namespace App\Http\Controllers;

use App\Models\JetskiPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user && $user->isAdmin()) {
            return redirect('/dashboard');
        }

        $packages = JetskiPackage::where('is_active', true)->get();
        return view('v_beranda.home', compact('packages'));
    }

    public function about()
    {
        return view('v_beranda.about');
    }
}