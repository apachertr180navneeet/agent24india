<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Setting;
use App\Models\Orders;

class SettingController extends Controller
{
    protected $pageTitle;

    public function __construct(){
        $this->pageTitle = 'Setting';
    }
    
    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Role' => ''
        ];

        $setting = Setting::orderBy('id', 'asc')->first();

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['setting'] = $setting;
        
        return view("admin.settings.index")->with($this->viewData);
    }

    public function edit(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([
            'site_title'            => 'required|string|max:255',
            'logo_title'            => 'required|string|max:255',
            'payment_gateway'       => 'required|string|max:255',

            'demo_1_video_url'      => 'nullable|url|max:255',
            'demo_2_video_url'      => 'nullable|url|max:255',
            'demo_3_video_url'      => 'nullable|url|max:255',

            // ✅ NEW TITLE VALIDATION
            'demo_video_title1'     => 'nullable|string|max:255',
            'demo_video_title2'     => 'nullable|string|max:255',
            'demo_video_title3'     => 'nullable|string|max:255',

            'logo_image'            => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // ✅ Get first setting or create new
        $setting = Setting::first() ?? new Setting();

        // ✅ Assign data
        $setting->site_title        = $validated['site_title'];
        $setting->logo_title        = $validated['logo_title'];
        $setting->payment_gateway   = $validated['payment_gateway'];

        $setting->demo_1_video_url  = $validated['demo_1_video_url'] ?? null;
        $setting->demo_2_video_url  = $validated['demo_2_video_url'] ?? null;
        $setting->demo_3_video_url  = $validated['demo_3_video_url'] ?? null;

        // ✅ NEW TITLE SAVE
        $setting->demo_vedio_titel1 = $validated['demo_video_title1'] ?? null;
        $setting->demo_vedio_titel2 = $validated['demo_video_title2'] ?? null;
        $setting->demo_vedio_titel3 = $validated['demo_video_title3'] ?? null;

        // ✅ Image Upload
        if ($request->hasFile('logo_image')) {

            $uploadPath = public_path('upload/setting');

            // Create folder if not exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Optional: delete old image
            if (!empty($setting->logo_image)) {
                $oldPath = public_path(str_replace(asset('public/'), '', $setting->logo_image));
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $image = $request->file('logo_image');

            $filename = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());

            $image->move($uploadPath, $filename);

            $setting->logo_image = asset('public/upload/setting/' . $filename);
        }

        // ✅ Save
        $setting->save();

        return redirect()
            ->route('admin.setting.index')
            ->with('success', 'Settings updated successfully.');
    }


    public function history()
    {
        $this->viewData['pageTitle'] = 'Payment History';

        $orders = Orders::select(
                'orders.*',
                'users.name as user_name',
                'users.mobile as user_mobile',
                'payment_transactions.razorpay_payment_id as utr_id'
            )
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('payment_transactions', 'payment_transactions.order_id', '=', 'orders.id')
            ->where('orders.status', '!=', 'pending')
            ->orderByDesc('payment_transactions.created_at') // ✅ best
            ->get();

        $this->viewData['orders'] = $orders;

        return view("admin.settings.payment")->with($this->viewData);
    }
}
