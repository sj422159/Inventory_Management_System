@extends('layouts.admin_master')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Products in Stock
    </div>
    <div class="card-body">
        <div class="table-responsive">
          <a href="{{ route('add.product') }}" class="btn btn-success">New Product</a>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Unit Price</th>
                        <th>Sale Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($products as $row)
                    <tr>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->category }}</td>
                        
                        @if($row->stock > '0')
                            <td>{{ $row->stock }}</td>
                        @else
                            <td>stockout</td>
                        @endif

                        <td>{{ $row->unit_price }}</td>
                        <td>{{ $row->sales_unit_price }}</td>
                        <td>
                        	<a href="#" class="btn btn-sm btn-info">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        	<a href="{{ 'purchase-products/'.$row->id }}" class="btn btn-sm btn-info">Purchase</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        
<script>
   


   $('#dataTable').DataTable({
    columnDefs: [
    {bSortable: false, targets: [6]} 
  ],
                dom: 'lBfrtip',
           buttons: [
               {
                   extend: 'copyHtml5',
                   exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                       columns: [ 0, ':visible' ]
                       
                   }
               },
               {
                   extend: 'excelHtml5',
                   exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [ 0, ':visible' ]
                   }
               },
               {
                   extend: 'pdfHtml5',
                   exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                       columns: [ 0, 1, 2, 5 ]
                   }
               },
               'colvis'
           ]
           });
       </script>
@endsection