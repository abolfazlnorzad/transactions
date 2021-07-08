<?php

namespace App\Http\Controllers;

use App\Http\Repo\CategoryRepo;
use App\Http\Repo\TransactionRepo;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //show all transaction
    public function index(TransactionRepo $repo)
    {
        $transactions = $repo->getAllTransactions();
        return view('transaction.index', compact('transactions'));
    }

    // show create new transaction form
    public function create(CategoryRepo $categoryRepo)
    {
        $categories = $categoryRepo->getAllCategories();
        return view('transaction.create', compact('categories'));
    }

    //store the new transaction
    public function store(TransactionRequest $request,TransactionRepo $transactionRepo)
    {
        $transactionRepo->store($request);
        return redirect()->route('transaction.index');
    }


    // download transaction file
    public function download(Transaction $transaction)
    {
        return response()->download(storage_path($transaction->file, null, ['Content-Type' => 'application/png']));
    }


}
