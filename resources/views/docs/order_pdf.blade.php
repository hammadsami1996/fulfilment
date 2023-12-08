@extends('docs.master', ['title' => 'ORDER'])

{{--@php--}}
{{--    $totalQty = 0; // Initialize the total quantity variable--}}
{{--@endphp--}}
@section('content')

{{--    <head>--}}
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    </head>--}}
    <div class="document">
        <div class="document-heading">
            <h3 style="text-align: center">Orders</h3>
            <div class="col col-6">
            <div class="grid grid-cols-2 gap-6">
                <span style="text-transform: uppercase">Customer Name:<strong> {{ isset($model->customer->name) ? $model->customer->name : '- ' }},</strong></span><br>
                <span style="text-transform: uppercase">Email: <strong>{{ isset($model->customer->email) ? $model->customer->email : '-' }}, </strong></span><br>
                <span style="text-transform: uppercase">Phone: <strong> {{ isset($model->customer->phone) ? $model->customer->phone : '-' }},</strong></span><br>
                <span style="text-transform: uppercase">Address: <strong> {{ isset($model->customer->b_address_1) ? $model->customer->b_address_1 : '-' }}</strong></span><br>
            </div>
            </div>
            <div class="col col-6 offset-md5">
                <table class="document-summary">
                    <tbody>
                    <tr>
                        <td><strong>Order Date:</stronG></td>
                        <td><strong>{{$model->order_date}} </strong></td>
                    </tr>
{{--                    <tr>--}}
{{--                        <td><strong>Company:</stronG></td>--}}
{{--                        <td><strong>{{$model->stores->compan}} </strong></td>--}}
{{--                    </tr>--}}
                    <tr>
                        <td><strong>Stores:</stronG></td>
                        <td><strong>{{$model->stores->name}} </strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
        <div class="document-body">
            <table class="document-table">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Title</th>
                    <th class="py-2 px-4 border">Sku</th>
                    <th class="py-2 px-4 border">Price</th>
                    <th class="py-2 px-4 border">Qty</th>
                    <th class="py-2 px-4 border">Total Amount</th>
                </tr>
                </thead>
                <tbody>
                {{$total_quantity = 0}}
                {{$total_price = 0}}
                {{$total = 0}}
                @foreach($model->items as $item)
                    {{--{{dd($model->items)}}--}}
                    <tr class="border h-10">
                        <td class="py-2 px-4 border">{{$item->id}}</td>
                        <td class="py-2 px-4 border ">{{$item->product_name}}</td>
                        <td class="py-2 px-4 border ">{{$item->sku}}</td>
                        <td class="py-2 px-4 border ">{{$item->unit_price}}</td>
                        <td class="py-2 px-4 border">{{$item->qty}}</td>
                        <td class="py-2 px-4 border">{{$item->qty * $item->unit_price}}</td>
                    </tr>
                    {{$total_quantity += $item->qty}}
                    {{$total_price += $item->unit_price * $item->qty}}
{{--                    {{dd($item->unit_price * $item->qty + $model->delivery_charges)}}--}}
                    {{$total += $item->unit_price * $item->qty + $model->delivery_charges}}
                @endforeach
                {{-- {{dd($model->sub_total)}}--}}
                <tr class="item-footer border">
                    <td colspan="3" class="border"></td>
                    <td colspan="1" class="border"><strong>Item(s) Total:</strong></td>
                    <td colspan="1" class="border">{{$total_quantity}}</td>
                    <td colspan="1" class="border">Rs.{{$total_price}}</td>
                </tr>
                {{--{{dd($model)}}--}}
                <tr class="item-footer border">
                    <td colspan="3" class="border"></td>
                    <td colspan="1" class="border"><strong>Delivery Charges:</strong></td>
                    <td colspan="1" class="border"></td>
                    <td colspan="1" class="border">Rs.{{$model->delivery_charges}}</td>
                </tr>
                <tr class="item-footer border">
                    <td colspan="3" class="border"></td>
                    <td colspan="1" class="border"><strong>Net Invoice Total:</strong></td>
                    <td colspan="1" class="border"></td>
                    <td colspan="1" class="border"><strong>Rs.{{$total}}</strong> </td>
                </tr>
                </tbody>
                        </table>

{{--            @if($model->terms)--}}
                <hr>
                <div class="document-footer row">
                    <div class="col col-12">
                        <strong>Item Summary</strong>
                        <div class="document-term">
                            {!!$model->item_summary  !!}
                        </div>
                    </div>
                </div>
{{--            @endif--}}
        </div>
    </div>
    <div class="document-footers row">
        <div class="col col-3 ">
            <div class="align-center px-6">
                <p style="margin-bottom: 5px;height: 20px">{{$model->created_user ? $model->created_user->name : ''}}</p>
                <div style="border-top: 1px solid #000000;text-align: center;"></div>
                <p style="margin-top: 5px"> Prepared By </p>
            </div>
        </div>
        <div class="col col-3 ">
            <div class="align-center px-5">
                <p style="margin-bottom: 5px;height: 20px">{{$model->reviewed_user ? $model->reviewed_user->name : ''}}</p>
                <div style="border-top: 1px solid #000000;text-align: center;"></div>
                <p style="margin-top: 5px"> Reviewed By</p>
            </div>
        </div>
        <div class="col col-3 ">
            <div class="align-center px-5">
                <p style="margin-bottom: 5px;height: 20px">{{$model->approved_user ? $model->approved_user->name : ''}}</p>
                <div style="border-top: 1px solid #000000;text-align: center;"></div>
                <p style="margin-top: 5px"> Approved By</p>
            </div>
        </div>
        <div class="col col-3 ">
            <div class="align-center px-5">
                <p style="margin-bottom: 5px;height: 20px">{{$model->recieved_user ? $model->recieved_user->name : ''}}</p>
                <div style="border-top: 1px solid #000000;text-align: center;"></div>
                <p style="margin-top: 5px"> Received By</p>
            </div>
        </div>
    </div>

@endsection


<style>
    .document-footers {
        position: fixed;
        bottom: 4%;
    }
</style>
