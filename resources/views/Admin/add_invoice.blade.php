@extends('layouts.admin_master')

@section('content')

<main>
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4"><b>Create New Invoice</b></h3></div>
    <div class="card-body">
        <form method="POST" action="{{url('/insert-invoice') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputFirstName">Customer Name</label>
                      @if(isset($customer) && $customer->name)
    <input class="form-control py-4" name="customer" type="text" value="{{ $customer->name }}" />
@elseif(isset($order) && $order->name)
    <input class="form-control py-4" name="customer" type="text" value="{{ $order->name }}" />
@else
    <input class="form-control py-4" name="customer" type="text" value="Unknown Customer" />
@endif

                    </div>
                </div>
                <div class="col-md-6">
                    @if(isset($customer) && $customer->email)
                    <div class="form-group">
                        <label class="small mb-1" for="inputFirstName">Customer Email</label>
                        <input class="form-control py-4" name="email" type="text" value="{{ $customer->email }}" />
                    </div>
                    @endif
                </div>
                @if(isset($customer) && $customer->company)
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputLastName">Company</label>
                        <input class="form-control py-4" name="company" type="text" value="{{ $customer->company }}" />
                    </div>
                </div>
                @endif
                 @if(isset($customer) && $customer->address)
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputLastName">Address</label>
                        <input class="form-control py-4" name="address" type="text" value="{{ $customer->address }}" />
                    </div>
                </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputState">Phone No.</label>
                        <input class="form-control py-4" name="phone" type="text" />
                    </div>
                </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputLastName">Product Category</label>
                        <input class="form-control py-4" name="item" type="text" value="{{ $product->category }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputLastName">Product Name</label>
                        <input class="form-control py-4" name="name" type="text" value="{{ $product->name }}" />
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputLastName">Price (perUnit)</label>
                        <input class="form-control py-4" name="unit_price" type="text" value="{{ $product->sales_unit_price }}" />
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputLastName">Quantity</label>
                        <input class="form-control py-4" name="quantity" type="text" value="{{ $order->quantity }}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputLastName">Total Price</label>
                        <input class="form-control py-4" name="total" type="text" value="{{ $product->sales_unit_price * $order->quantity }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small mb-1" for="inputLastName">Payment</label>
                        <input class="form-control py-4" name="payment" type="text" placeholder="" />
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

@endsection