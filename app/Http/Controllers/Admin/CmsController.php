<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Models\User;
use App\Models\Role;
use App\Models\Cms;
use Illuminate\Support\Facades\Cache;
use Auth;

class CmsController extends Controller
{
    protected $pageTitle;

    public function __construct(){
        $this->pageTitle = 'CMS Management';
    }
    
    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'CMS Management' => ''
        ];

        $cms = Cms::orderBy('id', 'asc')->get();

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['cms'] = $cms;
        
        return view("admin.cms.index")->with($this->viewData);
    }

    public function edit(Request $request, $id)
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'CMS Management' => route('admin.cms.index'),
            'Edit' => '',
        ];

        // CMS to edit
        $cms = Cms::findOrFail($id);
        
        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['cms'] = $cms;

        return view('admin.cms.edit')->with($this->viewData);
    }

 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            // Find CMS record
            $cms = Cms::findOrFail($id);

            // Update fields
            $cms->title       = $request->name;
            $cms->description = $request->description; // CKEditor content
            $cms->status      = $request->status ?? 1;
            $cms->updated_by  = auth()->id();
            $cms->save();

            // Invalidate cache immediately so frontend updates instantly
            Cache::forget('site_global_cms');

            // Success notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'CMS']),
                '_type'    => 'success',
            ];

            return redirect()
                ->route('admin.cms.index')
                ->with(['notification' => $notification]);

        } catch (\Exception $e) {
            // Error notification
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
