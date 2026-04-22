<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $query = Transaction::query()
            ->with([
                'type:id,name,code',
                'category:id,name,type_id'
            ])
            ->where('user_id', $userId);

        // 🔍 Filter jenis (income / expense)
        if ($request->filled('type')) {
            $query->whereHas('type', function ($q) use ($request) {
                $q->where('code', $request->type);
            });
        }

        // 🔍 Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 🔍 Filter tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('transaction_date', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // 🔽 Ambil data (JANGAN paginate kalau pakai DataTables biasa)
        $transactions = $query
            ->orderByDesc('transaction_date')
            ->get();

        // 🔹 Data untuk dropdown
        $types = Type::select('id', 'name')->get();

        $categoriesAll = Category::select('id', 'name', 'type_id')->get();

        return view('user.transaksi', compact(
            'transactions',
            'types',
            'categoriesAll'
        ));
    }

    public function create()
    {
        $types = Type::all();
        $categories = Category::select('id', 'name')->get();

        return view('user.create', compact('types', 'categories'));
    }

    public function store(Request $request)
    {
        Transaction::create([
            'user_id' => auth()->id(),
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        \DB::beginTransaction();

        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            \DB::commit();

            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            \DB::rollBack();

            return back()->with('error', 'Gagal menghapus data');
        }
    }
}
