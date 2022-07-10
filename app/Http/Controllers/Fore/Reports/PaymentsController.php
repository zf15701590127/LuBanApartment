<?php

namespace App\Http\Controllers\Fore\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $builder = Payment::query();

        $quantity = $builder->count();

        $payments = $builder->paginate(10);

        $search = '';

        return view('fore.reports.payments.index', [
            'payments' => $payments,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }
}
