<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\User;
use App\Models\District;
use App\Models\SupportForm;
use App\Models\PaidListing;

class DashboardController extends Controller
{
    protected $viewData = [];

    public function __construct()
    {
        // Optional middleware
        // $this->middleware('auth');
    }

    /**
     * Common reusable function for total, active & inactive counts
     */
    private function getStatusCounts($model, $conditions = [])
    {
        $query = $model::query();

        if (!empty($conditions)) {
            $query->where($conditions);
        }

        return $query->selectRaw("
            COUNT(id) AS total_count,
            COUNT(CASE WHEN status = 1 THEN id END) AS active_count,
            COUNT(CASE WHEN status = 0 THEN id END) AS inactive_count
        ")->first();
    }

    /**
     * Category Counts
     */
    public function getCategoryCounts()
    {
        return Category::whereNull('parent_id')
            ->selectRaw("
                COUNT(id) AS total_count,
                COUNT(CASE WHEN status = 1 THEN id END) AS active_count,
                COUNT(CASE WHEN status = 0 THEN id END) AS inactive_count
            ")->first();
    }

    /**
     * District Counts
     */
    public function getDistrictCounts()
    {
        return $this->getStatusCounts(District::class);
    }

    /**
     * Vendor Counts
     * Vendor = User with role VENDOR
     */
    public function getVendorCounts()
    {
        return $this->getStatusCounts(
            User::class,
            ['role_id' => config('constants.roles.VENDOR.value')]
        );
    }

    /**
     * Agent Counts
     */
    public function getAgentCounts()
    {
        return $this->getStatusCounts(
            User::class,
            ['role_id' => config('constants.roles.AGENT.value')]
        );
    }

    /**
     * Distributor Counts
     */
    public function getDistributorCounts()
    {
        return $this->getStatusCounts(
            User::class,
            ['role_id' => config('constants.roles.DISTRIBUTOR.value')]
        );
    }

    /**
     * Customer Counts with ITR Status
     */
    public function getCustomerCounts()
    {
        return User::where('role_id', config('constants.roles.CUSTOMER.value'))
            ->selectRaw("
                COUNT(id) AS total_count,
                COUNT(CASE WHEN status = 1 THEN id END) AS active_count,
                COUNT(CASE WHEN status = 0 THEN id END) AS inactive_count
            ")->first();
    }

    /**
     * Dashboard View
     */
    public function index()
    {
        $breadcrumb = [
            'Dashboard' => ''
        ];

        $data = [
            'categoryCounts'    => $this->getCategoryCounts(),
            'districtCounts'    => $this->getDistrictCounts(),
            'vendorCounts'      => $this->getVendorCounts(),
            'agentCounts'       => $this->getAgentCounts(),
            'distributorCounts' => $this->getDistributorCounts(),
            'customerCounts'    => $this->getCustomerCounts(),
        ];

        $supportFormCount = SupportForm::count();

        $PaidListingcounts = PaidListing::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) as pending
        ")->first();


        $this->viewData['pageTitle']  = 'Dashboard';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['data']       = $data;
        $this->viewData['supportFormCount'] = $supportFormCount;
        $this->viewData['PaidListingcounts'] = $PaidListingcounts;

        return view('admin.dashboard.dashboard')->with($this->viewData);
    }
}
