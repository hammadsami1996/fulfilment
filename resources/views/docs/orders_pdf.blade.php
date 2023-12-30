@extends('docs.master', ['title' => 'ORDER'])

@section('content')

{{--    {{dd($model )}}--}}
    @foreach($model as $parent)
{{--        {{dd($parent)}}--}}
        <div class="document">
            <div class="document-heading ">
                <h4 style="text-align: center; color: #333;  margin: 10px 10px;padding: 5px; text-decoration: underline; text-decoration-color: #0c0c0c;">Orders</h4>
                <div class="col col-4">
                    <div class="grid grid-cols-2 gap-6">
                        <span style="text-transform: uppercase">Customer Name:<strong> {{ isset($parent->customer->name) ? $parent->customer->name : '- ' }},</strong></span><br>
                        <span style="text-transform: uppercase">Email: <strong>{{ isset($parent->customer->email) ? $parent->customer->email : '-' }}, </strong></span><br>
                        <span style="text-transform: uppercase">Phone: <strong> {{ isset($parent->customer->phone) ? $parent->customer->phone : '-' }},</strong></span><br>
                        <span style="text-transform: uppercase">Address: <strong> {{ isset($parent->customer->b_address_1) ? $parent->customer->b_address_1 : '-' }}</strong></span><br>
                    </div>
{{--                    {{dd($parent->customer->name)}}--}}
                </div>
                <div class="col col-4">

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
                    @foreach($parent->items as $item)
{{--                        {{dd($parent->items)}}--}}
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
                        {{--                    {{dd($item->unit_price * $item->qty + $parent->delivery_charges)}}--}}
                        {{$total += $item->unit_price * $item->qty + $parent->delivery_charges}}
                    @endforeach
                    {{-- {{dd($parent->sub_total)}}--}}
                    <tr class="item-footer border">
                        <td colspan="3" class="border"></td>
                        <td colspan="1" class="border"><strong>Item(s) Total:</strong></td>
                        <td colspan="1" class="border">{{$total_quantity}}</td>
                        <td colspan="1" class="border">Rs.{{$total_price}}</td>
                    </tr>
                    {{--{{dd($parent)}}--}}
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
                        <td colspan="1" class="border"><strong>Rs.{{$total}}</strong> </td>
                    </tr>
                    </tbody>
                            </table>

                {{--            @if($parent->terms)--}}
                <hr>
                <div class="document-footer row">
                    <div class="col col-12">
                        <strong>Item Summary</strong>
                        <div class="document-term">
                            {!!$parent->item_summary  !!}
                        </div>
                    </div>
                </div>
                {{--            @endif--}}
            </div>
        </div>
        <div class="document-footers row">
            <div class="col col-3 ">
                <div class="align-center px-6">
                    <p style="margin-bottom: 5px;height: 20px">{{$parent->created_user ? $parent->created_user->name : ''}}</p>
                    <div style="border-top: 1px solid #000000;text-align: center;"></div>
                    <p style="margin-top: 5px"> Prepared By </p>
                </div>
            </div>
            <div class="col col-3 ">
                <div class="align-center px-5">
                    <p style="margin-bottom: 5px;height: 20px">{{$parent->reviewed_user ? $parent->reviewed_user->name : ''}}</p>
                    <div style="border-top: 1px solid #000000;text-align: center;"></div>
                    <p style="margin-top: 5px"> Reviewed By</p>
                </div>
            </div>
            <div class="col col-3 ">
                <div class="align-center px-5">
                    <p style="margin-bottom: 5px;height: 20px">{{$parent->approved_user ? $parent->approved_user->name : ''}}</p>
                    <div style="border-top: 1px solid #000000;text-align: center;"></div>
                    <p style="margin-top: 5px"> Approved By</p>
                </div>
            </div>
            <div class="col col-3 ">
                <div class="align-center px-5">
                    <p style="margin-bottom: 5px;height: 20px">{{$parent->recieved_user ? $parent->recieved_user->name : ''}}</p>
                    <div style="border-top: 1px solid #000000;text-align: center;"></div>
                    <p style="margin-top: 5px"> Received By</p>
                </div>
            </div>
        </div>
    @endforeach

@endsection


<style>

    /*.document-heading {*/
    /*    text-align: center;*/
    /*    color: #333; !* Set your preferred color *!*/
    /*    margin: 10px 0;*/
    /*    padding: 5px;*/
    /*    text-decoration: underline;*/
    /*    text-decoration-color: #0c0c0c;*/
    /*}*/
    .document-footers {
        position: fixed;
        bottom: 4%;
            }
</style>
<script>
    import Header from "@/Layouts/header";
    export default {
        components: {Header}
    }
</script>
