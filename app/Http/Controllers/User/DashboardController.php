<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // 🔹 Ambil transaksi + relasi (hanya kolom penting)
        $transactions = Transaction::with(['type:id,code', 'category:id,name'])
            ->where('user_id', $userId)
            ->get();

        // 🔹 Total pemasukan
        $totalIncome = $transactions
            ->filter(fn($t) => $t->type?->code === 'income')
            ->sum('amount');

        // 🔹 Total pengeluaran
        $totalExpense = $transactions
            ->filter(fn($t) => $t->type?->code === 'expense')
            ->sum('amount');

        // 🔹 Saldo
        $balance = $totalIncome - $totalExpense;

        // 🔹 Grafik bulanan
        $monthly = $transactions
            ->groupBy(fn($t) => date('n', strtotime($t->transaction_date)))
            ->map(function ($items, $month) {
                return [
                    'month' => $month,
                    'income' => $items->filter(fn($t) => $t->type?->code === 'income')->sum('amount'),
                    'expense' => $items->filter(fn($t) => $t->type?->code === 'expense')->sum('amount'),
                ];
            })
            ->values();

        // 🔹 Grafik kategori (pengeluaran)
        $categories = $transactions
            ->filter(fn($t) => $t->type?->code === 'expense')
            ->groupBy(fn($t) => $t->category?->name)
            ->map(function ($items, $name) {
                return [
                    'name' => $name,
                    'total' => $items->sum('amount'),
                ];
            })
            ->values();

        $types = Type::all();
        
        $categoriesAll = Category::select('id','name','type_id')->get();

        $transactions = Transaction::with(['type:id,name,code', 'category:id,name'])
            ->where('user_id', $userId)
            ->orderBy('transaction_date', 'desc')
            ->get();

        // dd($categoriesAll);
        return view('user.dashboard', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'monthly',
            'categories',
            'types',
            'categoriesAll',
            'transactions'
        ));
    }
}