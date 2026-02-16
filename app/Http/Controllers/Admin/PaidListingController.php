<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PaidListing;

class PaidListingController extends Controller
{
    protected $pageTitle;

    public function __construct(){
        $this->pageTitle = 'Paid Listing Management';
    }
    
    public function index()
    {
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Paid Listing' => ''
        ];

        $paidlisting = PaidListing::query()
            ->leftJoin('users', 'users.id', '=', 'paid_listing.bussines_id')

            // Home city (single district)
            ->leftJoin('districts as home_district', 'home_district.id', '=', 'paid_listing.home_city')

            // Multiple districts (comma-separated)
            ->leftJoin('districts as area_districts', function ($join) {
                $join->on(
                    DB::raw('FIND_IN_SET(area_districts.id, paid_listing.district)'),
                    '>',
                    DB::raw('0')
                );
            })

            ->select(
                'paid_listing.*',
                'users.name as business_name',
                'home_district.name as home_city',
                DB::raw('GROUP_CONCAT(DISTINCT area_districts.name) as district_names')
            )

            ->groupBy(
                'paid_listing.id',
                'users.name',
                'home_district.name'
            )

            ->orderBy('paid_listing.id', 'desc')
            ->get();

        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['paidlisting'] = $paidlisting;

        return view('admin.paid-listing.index')->with($this->viewData);
    }

    public function edit(Request $request, $id)
    {
        
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Paid Listing' => route('admin.paid-listing.index'),
            'Edit' => '',
        ];

        // User to edit
        $paidlisting = PaidListing::query()
            ->leftJoin('users', 'users.id', '=', 'paid_listing.bussines_id')

            // Home city (single district)
            ->leftJoin('districts as home_district', 'home_district.id', '=', 'paid_listing.home_city')

            // Multiple districts (comma-separated)
            ->leftJoin('districts as area_districts', function ($join) {
                $join->on(
                    DB::raw('FIND_IN_SET(area_districts.id, paid_listing.district)'),
                    '>',
                    DB::raw('0')
                );
            })

            ->select(
                'paid_listing.*',
                'users.name as business_name',
                'home_district.name as home_city',
                DB::raw('GROUP_CONCAT(DISTINCT area_districts.name) as district_names')
            )

            ->groupBy(
                'paid_listing.id',
                'users.name',
                'home_district.name'
            )

            ->orderBy('paid_listing.id', 'desc')
            ->first();

        // dd($paidlisting);
        
        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['paidlisting'] = $paidlisting;


        return view('admin.paid-listing.edit')->with($this->viewData);
    }

    /**
     * Update.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function update(Request $request, $id)
    {
        try {
            // ✅ Find CMS record
            $paidlisting = PaidListing::findOrFail($id);

            // ✅ Update fields
            $paidlisting->status      = $request->status;
            $paidlisting->save();

            DB::commit();

            // ✅ Success notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Paid Listing']),
                '_type'    => 'success',
            ];

            return redirect()
                ->route('admin.paid-listing.index')
                ->with(['notification' => $notification]);

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();

            // ❌ Error notification
            $notification = [
                '_status'  => false,
                '_message' => $e->getMessage(),
                '_type'    => 'error',
            ];

            return redirect()
                ->route('admin.cms.edit', $id)
                ->withInput()
                ->with(['notification' => $notification]);
        }
    }
}
