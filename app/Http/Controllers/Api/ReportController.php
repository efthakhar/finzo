<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;

class ReportController extends Controller {
	public function getDashBoardReports() {
		$total_incomes  = Income::sum('amount');
		$total_expenses = Expense::sum('amount');
		$net_incomes    = $total_incomes - $total_expenses;

		return response()->json([
            'total_incomes' => round($total_incomes,2),
            'total_expenses' => round($total_expenses,2),
            'net_incomes' => round($net_incomes,2),
		], 200);
	}
}
