@extends('admin.layout.main_app')
@section('title', $pageTitle)

@push('styles')
<link href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<style>
    #sortable tr { cursor: move; }
</style>
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $pageTitle }}</h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>District Name</th>
                        </tr>
                    </thead>

                    <tbody id="sortable">
                        @foreach($districts as $district)
                        <tr data-id="{{ $district->id }}">
                            <td>{{ $district->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
$(function () {
    $("#sortable").sortable({
        update: function () {
            let order = [];

            $("#sortable tr").each(function (index) {
                order.push({
                    id: $(this).data("id"),
                    position: index + 1
                });
            });

            $.ajax({
                url: "{{ route('admin.district.updateOrder') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order
                },
                success: function () {
                    alert("Order Updated Successfully");
                }
            });
        }
    });
});
</script>
@endpush
