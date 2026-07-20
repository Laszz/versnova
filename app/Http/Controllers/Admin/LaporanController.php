<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class LaporanController extends Controller
{
    public function index()
    {
        $daily = Transaction::whereDate('created_at', today())->sum('total_price');
        $monthly = Transaction::whereMonth('created_at', now()->month)->sum('total_price');
        $total = Transaction::sum('total_price');

        return view('admin.laporan.index', compact('daily', 'monthly', 'total'));
    }
}
