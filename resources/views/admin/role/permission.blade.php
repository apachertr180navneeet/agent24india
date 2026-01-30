@extends('admin.layout.main_app')
@section('title', $pageTitle)

@push('styles')
<!-- Select2 css-->
<link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('public/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

<style>
    .bootstrap-select.btn-group > .dropdown-toggle{
        padding: 8px 10px !important;
    }
    /*input[type='text'], input[type='email']{
        text-transform: uppercase;
    }*/
</style>
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Permission</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('admin.role.updatePermissions') }}" method="post" id="add-form" enctype="multipart/form-data">
                            @csrf
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Hidden input -->
                                <input type="hidden" name="role_id" id="role_id" value="{{ $role->id }}">
                                <!-- Hidden input -->

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Role Name</label>
                                            <div class="form-control">{{$role->name}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Status</label>
                                            <div class="form-control">{{$role->status == 1 ? 'Active' : 'Inactive'}}</div>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($permissions))
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th width="40" class="text-center">
                                                <label for="all_parent_permission">All</label><br/>
                                                <input type="checkbox" name="view" id="all_parent_permission" class="all_parent_permission" onchange="checkAllParent();">
                                            </th>
                                            <th width="200">Name</th>
                                            <th width="100" class="text-center">
                                                <label for="all_view_permission">View</label><br/>
                                                <input type="checkbox" name="view" id="all_view_permission" class="all_view_permission" onchange="checkAllByType('view');">
                                            </th>
                                            <th width="100" class="text-center">
                                                <label for="all_add_permission">Add</label><br/>
                                                <input type="checkbox" name="add" id="all_add_permission" class="all_add_permission" onchange="checkAllByType('add');">
                                            </th>
                                            <th width="100" class="text-center">
                                                <label for="all_edit_permission">Edit</label><br/>
                                                <input type="checkbox" name="edit" id="all_edit_permission" class="all_edit_permission" onchange="checkAllByType('edit');">
                                            </th>
                                            <th width="100" class="text-center">
                                                <label for="all_delete_permission">Delete</label><br/>
                                                <input type="checkbox" name="delete" id="all_delete_permission" class="all_delete_permission" onchange="checkAllByType('delete');">
                                            </th>
                                        </tr>
                                    
                                    {{-- @foreach($permissions as $key => $value)
                                        <tr class="row-{{$value->id}}">
                                            <td class="text-center" >
                                                <input type="checkbox" name="permission_{{$key+1}}" id="permission_{{$key+1}}" class="all_permission_{{$value->id}} all_permission" data-permission-id="{{$value->id}}" onchange="checkAllById(this);">
                                            </td>
                                            <td>{{$value->name}}</td>
                                            <td class="text-center">
                                                <input type="checkbox" name="permissions[]" id="view_permission_{{$key+1}}" class="view_permission permission_{{$value->id}}" data-permission-id="{{$value->id}}" onchange="checkRow({{$value->id}});" value="{{$value->id}}">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="permissions[]" id="add_permission_{{$key+1}}" class="add_permission permission_{{$value->id}}" data-permission-id="{{$value->id}}" onchange="checkRow({{$value->id}});" value="{{$value->id}}">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="permissions[]" id="edit_permission_{{$key+1}}" class="edit_permission permission_{{$value->id}}" data-permission-id="{{$value->id}}" onchange="checkRow({{$value->id}});" value="{{$value->id}}">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="permissions[]" id="delete_permission_{{$key+1}}" class="delete_permission permission_{{$value->id}}" data-permission-id="{{$value->id}}" onchange="checkRow({{$value->id}});" value="{{$value->id}}">
                                            </td>
                                        </tr>
                                    @endforeach --}}

                                    @php
                                    $rolePermissionsData = $role->permissions->pluck('name')->toArray();
                                    @endphp

                                    @foreach($modules as $key => $value)
                                        @php
                                        $getPermissions = $permissions->where('module_name', $value);
                                        $getPermissions = $getPermissions->values();
                                        $moduleName = strtolower(str_replace(' ', '_', $value));
                                        $viewPermissionName = $getPermissions[0]->name;
                                        $addPermissionName = $getPermissions[1]->name;
                                        $editPermissionName = $getPermissions[2]->name;
                                        $deletePermissionName = $getPermissions[3]->name;

                                        $checkedView = '';
                                        $checkedAdd = '';
                                        $checkedEdit = '';
                                        $checkedDelete = '';
                                        
                                        if($role->hasPermissionTo($viewPermissionName)){
                                            $checkedView = 'checked';
                                        }

                                        if($role->hasPermissionTo($addPermissionName)){
                                            $checkedAdd = 'checked';
                                        }
                                        
                                        if($role->hasPermissionTo($editPermissionName)){
                                            $checkedEdit = 'checked';
                                        }
                                        
                                        if($role->hasPermissionTo($deletePermissionName)){
                                            $checkedDelete = 'checked';
                                        }
                                        @endphp

                                        <tr class="permission-row row-{{$moduleName}}">
                                            <td class="text-center" >
                                                <input type="checkbox" name="permission_{{$key+1}}" id="permission_{{$key+1}}" class="all_permission_{{$moduleName}} all_permission" data-permission-name="{{$moduleName}}" onchange="checkAllById(this);">
                                            </td>
                                            <td>{{$value}}</td>
                                            <td class="text-center">
                                                <input type="checkbox" name="permissions[]" id="view_permission_{{$key+1}}" class="view_permission permission_{{$moduleName}}" data-permission-name="{{$moduleName}}" onchange="checkRow('{{$moduleName}}');" value="{{$viewPermissionName}}" {{$checkedView}}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="permissions[]" id="add_permission_{{$key+1}}" class="add_permission permission_{{$moduleName}}" data-permission-name="{{$moduleName}}" onchange="checkRow('{{$moduleName}}');" value="{{$addPermissionName}}" {{$checkedAdd}}>
                                            </td>   
                                            <td class="text-center">
                                                <input type="checkbox" name="permissions[]" id="edit_permission_{{$key+1}}" class="edit_permission permission_{{$moduleName}}" data-permission-name="{{$moduleName}}" onchange="checkRow('{{$moduleName}}');" value="{{$editPermissionName}}" {{$checkedEdit}}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="permissions[]" id="delete_permission_{{$key+1}}" class="delete_permission permission_{{$moduleName}}" data-permission-name="{{$moduleName}}" onchange="checkRow('{{$moduleName}}');" value="{{$deletePermissionName}}" {{$checkedDelete}}>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    </table>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <!-- Card footer -->
                            <div class="card-footer">
                                <div class="row row-sm">
                                    <div class="col-md-12 col-lg-12 col-xl-12 text-right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.Card footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script src="{{ asset('public/plugins/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('public/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('public/js/components.js') }}"></script>
<script src="{{ asset('public/js/role/create.js') }}"></script>

<script>
    function checkAllByType(typeName){
        if($(".all_"+typeName+"_permission").is(":checked")){
            $("."+typeName+"_permission").prop("checked", true);
        }
        else{
            $("."+typeName+"_permission").prop("checked", false);
        }

        if($(".all_view_permission").is(":checked") && $(".all_add_permission").is(":checked") && $(".all_edit_permission").is(":checked") && $(".all_delete_permission").is(":checked")){
            console.log('all checked');
            
            $(".all_permission").prop("checked", true);
        }
        else{
            console.log('all not checked');
            $(".all_permission").prop("checked", false);
        }

        // Check parent add checkbox
        if($(".all_permission:checked").length == $(".all_permission").length){
            $(".all_parent_permission").prop("checked", true);
        }
        else{
            $(".all_parent_permission").prop("checked", false);
        }
    }

    function checkAllById(element){
        var dataPermissionName = $(element).data('permission-name');

        if($(element).is(":checked")){
            $(".permission_"+dataPermissionName).prop("checked", true);
        }
        else{
            $(".permission_"+dataPermissionName).prop("checked", false);
        }

        // Check parent add checkbox
        if($(".all_permission:checked").length == $(".all_permission").length){
            $(".all_parent_permission").prop("checked", true);
        }
        else{
            $(".all_parent_permission").prop("checked", false);
        }

        checkIndividualParent();
    }

    function checkRow(permissionName){
        var checkPermissionCount = 0;

        checkPermissionCount = $(".row-"+permissionName).find('.permission_'+permissionName+':checked').length;
        console.log(checkPermissionCount, permissionName);
        
        
        if(checkPermissionCount == 4){
            $(".all_permission_"+permissionName).prop("checked", true);
        }
        else{
            $(".all_permission_"+permissionName).prop("checked", false);
        }

        // Check parent add checkbox
        if($(".all_permission:checked").length == $(".all_permission").length){
            $(".all_parent_permission").prop("checked", true);
        }
        else{
            $(".all_parent_permission").prop("checked", false);
        }

        checkIndividualParent();
    }

    function checkAllParent(){
        if($(".all_parent_permission").is(":checked")){
            $(".all_permission").prop("checked", true).trigger('change');
        }
        else{
            $(".all_permission").prop("checked", false).trigger('change');
        }

        checkIndividualParent();
    }

    function checkIndividualParent(){
        // Check parent view checkbox
        if($(".view_permission:checked").length == $(".view_permission").length){
            $(".all_view_permission").prop("checked", true);
        }
        else{
            $(".all_view_permission").prop("checked", false);
        }

        // Check parent add checkbox
        if($(".add_permission:checked").length == $(".add_permission").length){
            $(".all_add_permission").prop("checked", true);
        }
        else{
            $(".all_add_permission").prop("checked", false);
        }

        // Check parent edit checkbox
        if($(".edit_permission:checked").length == $(".edit_permission").length){
            $(".all_edit_permission").prop("checked", true);
        }
        else{
            $(".all_edit_permission").prop("checked", false);
        }

        // Check parent delete checkbox
        if($(".delete_permission:checked").length == $(".delete_permission").length){
            $(".all_delete_permission").prop("checked", true);
        }
        else{
            $(".all_delete_permission").prop("checked", false);
        }
    }

    $(document).ready(function(){
        checkIndividualParent();

        setTimeout(() => {
            $(".permission-row").each(function(key, element){
                var checkPermissionCount = 0;
                var checkPermissionName = '';
    
                $(element).find('td').each(function(rKey, rElement){
                    if($(rElement).find('.view_permission').is(":checked")){
                        checkPermissionCount += 1;
                        checkPermissionName = $(rElement).find('.view_permission').data('permission-name');
                    }
    
                    if($(rElement).find('.add_permission').is(":checked")){
                        checkPermissionCount += 1;
                        checkPermissionName = $(rElement).find('.add_permission').data('permission-name');
                    }
    
                    if($(rElement).find('.edit_permission').is(":checked")){
                        checkPermissionCount += 1;
                        checkPermissionName = $(rElement).find('.edit_permission').data('permission-name');
                    }
    
                    if($(rElement).find('.delete_permission').is(":checked")){
                        checkPermissionCount += 1;
                        checkPermissionName = $(rElement).find('.delete_permission').data('permission-name');
                    }
                });
    
                if(checkPermissionCount == 4){
                    $(".all_permission_"+checkPermissionName).prop("checked", true);
                }
                
                // Check parent all checkbox
                if($(".all_permission:checked").length == $(".all_permission").length){
                    $(".all_parent_permission").prop("checked", true);
                }
                else{
                    $(".all_parent_permission").prop("checked", false);
                }
            });
        }, 100);
    });
</script>
@endpush