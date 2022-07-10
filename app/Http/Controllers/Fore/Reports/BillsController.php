<?php

namespace App\Http\Controllers\Fore\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;

class BillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $builder = Bill::query();

        $quantity = $builder->count();

        $bills = $builder->paginate(10);

        $search = '';

        return view('fore.reports.bills.index', [
            'bills' => $bills,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }
}
