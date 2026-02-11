<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Models\User;
use App\Models\Role;
use App\Models\SupportForm;
use Auth;

class SupportFormController extends Controller
{
    protected $pageTitle;

    public function __construct(){
        $this->pageTitle = 'Support Form Management';
    }
    
    public function index()
    {
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Support Form' => ''
        ];

        $supportform = SupportForm::get();

        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['supportform'] = $supportform;

        return view('admin.support_form.index')->with($this->viewData);
    }

    public function edit(Request $request, $id)
    {   
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Support Form' => route('admin.support-form.index'),
            'Edit' => '',
        ];

        // User to edit
        $SupportForm = SupportForm::find($id);
        
        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['supportform'] = $SupportForm;


        return view('admin.support_form.edit')->with($this->viewData);
    }
}
