<?php

namespace App\Http\Repo;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

class TransactionRepo
{


    //get all transaction
    public function getAllTransactions()
    {
      return Transaction::all();
    }


    //store new transaction
    public function store($request)
    {
        $data  = $request->all();
        $file = $request->file('file');
        $fileName = Str::random(7) . "." . $file->getClientOriginalExtension();
        $year = now()->year;
        $month = now()->month;
        $day = now()->day;
        $file->move(storage_path("app/private/$year/$month/$day/"), $fileName);
        $fileDir = ("app/private/$year/$month/$day/") . $fileName;

      return Transaction::query()->create([
            "user_id" => auth()->user()->id,
            "category_id" => $data['category_id'],
            "description" => $data['description'],
            "status" => $data['status'],
            "file" => $fileDir,
            "cart" => $data['cart'],
            "price" => $data['price'],
            "date" => Jalalian::fromFormat('Y/m/d', $data["date"])->toCarbon(),
        ]);
    }

    //deposit in every month
    public function howDepositInMonth($month, $year)
    {
        return Transaction::query()
            ->where('status', 'deposit')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum("price");
    }

    //withdraw in every month
    public function howWithdrawInMonth($month, $year)
    {
        return  Transaction::query()
            ->where('status', 'withdraw')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum("price");

    }

    //get price for Every month base on category
    public function getPriceForEveryMonth($category, $date)
    {
        if ($date === null)
            $date = Carbon::now()->format("Y/m");
        $year = Str::beforeLast($date, "/");
        $month = Str::afterLast($date, "/");
        return  Transaction::query()
            ->where('category_id', $category->id)
            ->whereMonth("date", $month)
            ->whereYear("date", $year)
            ->sum("price");
    }


}
