@extends('docs.master', ['title' => 'ORDER'])


@section('content')

    {{--    {{dd($model )}}--}}
    @foreach($model as $parent)
        {{--        {{dd($parent)}}--}}
        <div id="customer_cn" class="bg-white font-arial-narrow text-sm w-full mb-4 break-inside-avoid">
            <table class="w-full border border-collapse">
                @php
                    $serialNo = 1 ;
                @endphp
                <tbody>
                <tr>
                    <td class="p-0 border border-black" colspan="3">
                        <table class="w-full border border-black">
                            <thead>
                            <tr>
                                <th class="border border-black text-center py-2">Serial No</th>
                                <td class="border border-black text-center py-2">{{$serialNo}}</td>
                                <th class="border border-black text-center py-2">Order Details</th>
                            </tr>
                            <tr>
                                <th class="border border-black text-center py-1">Order Id:</th>
                                <th class="border border-black text-center py-1"><strong>{{ isset($parent->order_id) ? $parent->order_id : '- ' }}</strong></th>
                            </tr>
                            <tr>
                                <th class="border border-black text-center py-1">Date:</th>
                                <th class="border border-black text-center py-1"><strong>{{ isset($parent->order_date) ? $parent->order_date : '- ' }}</strong></th>
                            </tr>
                            <tr>
                                <th class="border border-black text-center py-1">Inovice:</th>
                                <th class="border border-black text-center py-1"><strong>{{ isset($parent->sub_total) ? $parent->sub_total : '- ' }}</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th class="border border-black text-center py-1">Consignee Name:</th>
                                <th class="border border-black text-center py-1"><strong>{{ isset($parent->customer->name) ? $parent->customer->name : '- ' }}</strong></th>
                            </tr>
                            <tr>
                                <td class="border border-black text-center py-1">Consignee Email:</td>
                                <td class="border border-black text-center py-1">{{ isset($parent->customer->email) ? $parent->customer->email : '- ' }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black text-center py-1">Consignee Phone:</td>
                                <td class="border border-black text-center py-1">{{ isset($parent->customer->phone) ? $parent->customer->phone : '- ' }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black text-center py-1">Ship to City:</td>
                                <td class="border border-black text-center py-1">{{ isset($parent->city->name) ? $parent->city->name : '- ' }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black text-center py-1">Ship to Address:</td>
                                <td class="border border-black text-center py-1">{{ isset($parent->customer->b_address_1) ? $parent->customer->b_address_1 : '-' }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black text-center py-1">Other Instructions:</td>
                                <td class="border border-black text-center py-1"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <hr>
        </div>

        <div class="document">
            <div class="document-heading">
                <h3 style="text-align: center">Orders</h3>
                <div class="col col-4">
                    <div class="grid grid-cols-2 gap-6">
                        <span style="text-transform: uppercase">Customer Name:<strong> {{ isset($parent->customer->name) ? $parent->customer->name : '- ' }},</strong></span><br>
                        <span style="text-transform: uppercase">Email: <strong>{{ isset($parent->customer->email) ? $parent->customer->email : '-' }}, </strong></span><br>
                        <span style="text-transform: uppercase">Phone: <strong> {{ isset($parent->customer->phone) ? $parent->customer->phone : '-' }},</strong></span><br>
                        <span
                            style="text-transform: uppercase">Address: <strong> {{ isset($parent->customer->b_address_1) ? $parent->customer->b_address_1 : '-' }}</strong></span><br>
                    </div>
                    {{--                    {{dd($parent->customer->name)}}--}}
                </div>
                <div class="col col-4">
                    &nbsp;
                </div>
                <div class="col col-4 offset-md5">
                    <table class="document-summary">
                        <tbody>
                        <tr>
                            <td><strong>Order Date:</stronG></td>
                            <td><strong>{{$parent->order_date}} </strong></td>
                        </tr>
                        {{--                    <tr>--}}
                        {{--                        <td><strong>Company:</stronG></td>--}}
                        {{--                        <td><strong>{{$parent->stores->compan}} </strong></td>--}}
                        {{--                    </tr>--}}
                        <tr>
                            <td><strong>Stores:</stronG></td>
                            <td><strong>{{$parent->stores->name}} </strong></td>
                            {{--                            {{dd($parent->stores->name)}}--}}

                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="document-body">
                <table class="document-table w-full border-collapse border">
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
                    @php
                        $totalQuantity = 0;
                        $totalPrice = 0;
                        $total = 0;
                    @endphp
                    @foreach($parent->items as $item)
                        <tr class="border">
                            <td class="py-2 px-4 border">{{$item->id}}</td>
                            <td class="py-2 px-4 border">{{$item->product_name}}</td>
                            <td class="py-2 px-4 border">{{$item->sku}}</td>
                            <td class="py-2 px-4 border">Rs.{{$item->unit_price}}</td>
                            <td class="py-2 px-4 border">{{$item->qty}}</td>
                            <td class="py-2 px-4 border">Rs.{{$item->qty * $item->unit_price}}</td>
                        </tr>
                        @php
                            $totalQuantity += $item->qty;
                            $totalPrice += $item->unit_price * $item->qty;
                            $total += $item->unit_price * $item->qty + $parent->delivery_charges;
                        @endphp
                    @endforeach

                    <tr class="item-footer border">
                        <td colspan="3" class="border"></td>
                        <td colspan="1" class="border"><strong>Item(s) Total:</strong></td>
                        <td colspan="1" class="border">{{$totalQuantity}}</td>
                        <td colspan="1" class="border">Rs.{{$totalPrice}}</td>
                    </tr>

                    <tr class="item-footer border">
                        <td colspan="3" class="border"></td>
                        <td colspan="1" class="border"><strong>Delivery Charges:</strong></td>
                        <td colspan="1" class="border"></td>
                        <td colspan="1" class="border">Rs.{{$parent->delivery_charges}}</td>
                    </tr>

                    <tr class="item-footer border">
                        <td colspan="3" class="border"></td>
                        <td colspan="1" class="border"><strong>Net Invoice Total:</strong></td>
                        <td colspan="1" class="border"></td>
                        <td colspan="1" class="border"><strong>Rs.{{$total}}</strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    @endforeach

@endsection


<style>
    /*.document-footers {*/
    /*    position: fixed;*/
    /*    bottom: 4%;*/
    /*      */
    /*}*/
</style>
