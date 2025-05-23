@extends('layouts.admin_master')

@section('content')

<main>
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-7">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">New Order</h3></div>
        <div class="card-body">
            <form method="POST" action="{{url('/insert-new-order') }}" enctype="multipart/form-data">
            @csrf
                    <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputFirstName">Customer Name</label>
                            <select id="name" name="name" class="form-control">
                                <option selected>Choose...</option>
                                @foreach($customers as $c)
                                    <option value="{{$c->id}}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    
                        <div class="col-md-6">
                        <div class="form-group" id="email">
                            <!-- <label class="small mb-1" for="inputFirstName">Customer Email</label>
                            <input class="form-control py-4" name="email" type="text"/> -->
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group" id="company">
                            <!-- <label class="small mb-1" for="inputLastName">Company</label>
                            <input class="form-control py-4" name="company" type="text" /> -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="address">
                            <!-- <label class="small mb-1" for="inputState">Address</label>
                            <input class="form-control py-4" name="address" type="text" /> -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="phone">
                            <!-- <label class="small mb-1" for="inputState">Phone No.</label>
                            <input class="form-control py-4" name="phone" type="text" /> -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputState">Product Code</label>
                            <select id="inputState" name="code" class="form-control">
                            <option selected>Choose...</option>
                            @foreach($products as $row)
                                @if( $row->stock > 1)
                                    <option>{{ $row->product_code }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputState">Product Name</label>
                            <select id="inputState" name="name" class="form-control">
                            <option selected>Choose...</option>
                            @foreach($products as $row)
                                @if( $row->stock > 1)
                                    <option value="{{$row->product_code}}">{{ $row->name }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputLastName">Quantity</label>
                            <input class="form-control py-4" name="quantity" type="text"  />
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block">Submit</button></div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js"></script>
<script>
$(document).ready(function(){
$("#name").change(function() {
    var c_name = $("#name").val(); 
    console.log(c_name);
    $.ajax({
        type: 'POST',
        url: "https://127.0.0.1:8000/api/get-customer",
        dataType: 'json',
        data: {
            "id" : c_name
        },
        success: function(data) {
            console.log(data);
            $("#email").html('<label class="small mb-1" for="inputFirstName">Customer Email</label>');
            var x = '<input class="form-control py-4" name="email" value="'+data.customer.email+'" type="text"/>';
            $("#email").append(x);

            $("#company").html('<label class="small mb-1" for="inputFirstName">Customer company</label>');
            var x = '<input class="form-control py-4" name="company" value="'+data.customer.company+'" type="text"/>';
            $("#company").append(x);

            $("#phone").html('<label class="small mb-1" for="inputFirstName">Customer Phone</label>');
            var x = '<input class="form-control py-4" name="phone" value="'+data.customer.phone+'" type="text"/>';
            $("#phone").append(x);

            $("#address").html('<label class="small mb-1" for="inputFirstName">Customer Address</label>');
            var x = '<input class="form-control py-4" name="address" value="'+data.customer.address+'" type="text"/>';
            $("#address").append(x);
        }
    });
});
});
</script>
@endsection