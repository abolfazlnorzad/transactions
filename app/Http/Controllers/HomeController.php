<?php

namespace App\Http\Controllers;

use App\Http\Repo\CategoryRepo;
use App\Http\Repo\HomeRepo;
use App\Http\Repo\TransactionRepo;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\CarbonPeriod;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(TransactionRepo $repo, CategoryRepo $categoryRepo)
    {
        //get last 12 Month
        $data = collect(range(11, 0));
        $yearAndMonth = $data->map(function ($i) {
            $dt = today()->startOfMonth()->subMonth($i);
            return [
                "fullDate" => $dt->format('Y/m/d'),
                "yearAndMonth" => $dt->format('Y/m')
            ];
        });

        //get All Categories
        $categories = $categoryRepo->getAllCategories();

        // return view and pass Variables
        return view('home', compact('repo', 'yearAndMonth', 'categories'));
    }
}












//$depositInMonth = Transaction::query()->where('status', 'deposit')
//    ->get()
//    ->groupBy(function ($date) {
//        return Carbon::parse($date->created_at)->format('m');
//    });
//
//$withdrawInMonth = Transaction::query()->where('status', 'withdraw')
//    ->get()
//    ->groupBy(function ($date) {
//        return Carbon::parse($date->created_at)->format('m');
//    });
