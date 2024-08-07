<?php

// app/Http/Controllers/StatisticController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Transaction;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->query('period', 'day');
        $startDate = Carbon::now();

        switch ($period) {
            case 'week':
                $startDate = $startDate->subWeek();
                break;
            case 'month':
                $startDate = $startDate->subMonth();
                break;
            case 'day':
            default:
                $startDate = $startDate->subDay();
                break;
        }

        $income = Transaction::where('type', 'income')
            ->where('created_at', '>=', $startDate)
            ->sum('balance');

        $outcome = Transaction::where('type', 'outcome')
            ->where('created_at', '>=', $startDate)
            ->sum('balance');

        return response()->json([
            'income' => $income,
            'outcome' => $outcome,
        ]);
    }
}
