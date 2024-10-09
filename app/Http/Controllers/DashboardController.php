<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        ############################## Start Get all Customer ###############################
        // $currentMonth = Carbon::now()->startOfMonth();
        // $lastMonth = (clone $currentMonth)->subMonth();

        // $customers = Customer::get();
        // $countCustomers = Customer::get();

        // $currentMonthCustomer = $countCustomers->where('created_at', '>=', $currentMonth)->count();
        // $lastMonthCustomer = $countCustomers->where('created_at', '>=', $lastMonth)
        //     ->where('created_at', '<', $currentMonth)
        //     ->count();
        // if ($lastMonthCustomer == 0) {
        //     $customerPercentageIncrease = $currentMonthCustomer * 100;
        // } else {
        //     $customerPercentageIncrease = (($currentMonthCustomer - $lastMonthCustomer) / $lastMonthCustomer) * 100;
        // }
        // $customerIncrease = round($customerPercentageIncrease, 2);
        ############################## End Get all Customer #################################

        ############################## Start Get all Service ###############################

        // $services = Service::get();
        // $countServices = Service::get();

        // $currentMonthService = $countServices->where('created_at', '>=', $currentMonth)->count();
        // $lastMonthService = $countServices->where('created_at', '>=', $lastMonth)
        //     ->where('created_at', '<', $currentMonth)
        //     ->count();
        // if ($lastMonthService == 0) {
        //     $servicePercentageIncrease = $currentMonthService * 100;
        // } else {
        //     $servicePercentageIncrease = (($currentMonthService - $lastMonthService) / $lastMonthService) * 100;
        // }
        // $serviceIncrease = round($servicePercentageIncrease, 2);
        ############################## End Get all Service #################################

        ############################## Start Get all Branch ###############################

        // $branches = Branch::get();
        // $countBranches = Branch::get();

        // $currentMonthBranch = $countBranches->where('created_at', '>=', $currentMonth)->count();
        // $lastMonthBranch = $countBranches->where('created_at', '>=', $lastMonth)
        //     ->where('created_at', '<', $currentMonth)
        //     ->count();
        // if ($lastMonthBranch == 0) {
        //     $branchPercentageIncrease = $currentMonthBranch * 100;
        // } else {
        //     $branchPercentageIncrease = (($currentMonthBranch - $lastMonthBranch) / $lastMonthBranch) * 100;
        // }
        // $branchIncrease = round($branchPercentageIncrease, 2);
        ############################## End Get all Branch #################################

        ########################## Start Statics For Chart Emplyee ###########################

        // $startDate = Carbon::now()->subMonths(11)->startOfMonth(); // 11 months ago from now, start of the month
        // $endDate = Carbon::now()->endOfMonth(); // current month, end of the month

        // // Generate an array with all months within the last 12 months
        // $allMonthEmplyee = [];
        // for ($date = $startDate->copy(); $date->lte($endDate); $date->addMonth()) {
        //     $allMonthEmplyee[$date->format('Y-m')] = null;
        // }

        // Query for Reservation counts grouped by month within the last 12 months
        // $monthlyEmployeeCount = Employee::select(
        //     DB::raw('COUNT(id) as count'),
        //     DB::raw('YEAR(created_at) as year'),
        //     DB::raw('MONTH(created_at) as month')
        // )
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->groupBy('year', 'month')
        //     ->orderBy('year', 'asc')
        //     ->orderBy('month', 'asc')
        //     ->get()
        //     ->mapWithKeys(function ($item) {
        //         $month = $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
        //         return [$month => $item->count];
        //     });

        // Merge with all months, replacing missing values with null or 0
        // $completeMonthlyEmployeeCount = collect($allMonthEmplyee)->merge($monthlyEmployeeCount);

        // // Get the counts as an array
        // $employeeCountsArray = array_values($completeMonthlyEmployeeCount->toArray());
        // $employeeMonths = array_keys($completeMonthlyEmployeeCount->toArray());

        // // Optional: Replace null values with 0
        // $employeesArray = array_map(function ($count) {
        //     return $count === null ? 0 : $count;
        // }, $employeeCountsArray);

        ########################### End Statics For Chart Emplyee #########################

        return view('dashboard');
    }
}
