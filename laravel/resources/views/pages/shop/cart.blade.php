@extends('layouts/pagesMaster')

@section('content')
    @php
        error_reporting(0);
        $message = $message->message;
        $total = Cart::total();
    @endphp
    <div class="container">
        <p><a href="{{ url('shop') }}">Home</a> / Cart</p>
        <h1>Your Cart</h1>

        <hr>

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        @if (sizeof(Cart::content()) > 0)

            <table class="table">
                <thead>
                <tr>

                    <th>Product</th>
                    <th></th>
                    <th>Size</th>
                    <th>Price</th>
                    <th class="column-spacer"></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr class="border-bottom">
                @foreach (Cart::content() as $item)
                    <tr>
                        <td class="item-name"><a href="{{ url('shop', [$item->name]) }}">{{ $item->name }}</a></td>
                        <td>
                            {{--<select class="quantity" data-id="{{ $item->rowId }}">--}}
                            {{--<option value="{{ $item->qty == 1 ? 'selected' : '' }}">1</option>--}}
                            {{--<option value="{{ $item->qty == 2 ? 'selected' : '' }}">2</option>--}}
                            {{--<option value="{{ $item->qty == 3 ? 'selected' : '' }}">3</option>--}}
                            {{--<option value="{{ $item->qty == 4 ? 'selected' : '' }}">4</option>--}}
                            {{--<option value="{{ $item->qty == 5 ? 'selected' : '' }}">5</option>--}}
                            {{--</select>--}}
                        </td>
                        <td>{{$item->size}}</td>
                        <td>€{{ $item->subtotal }}</td>
                        <td class=""></td>
                        <td>
                            <form action="{{ action('CartController@destroy', $item->rowId) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                {{method_field('DELETE')}}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger btn-sm btn-checkout" value="Remove">
                            </form>
                        </td>
                    </tr>

                @endforeach
                <tr>
                    <td class="table-image"></td>
                    <td></td>
                    <td></td>
                    <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                    <td>€{{ Cart::instance('default')->subtotal() }}</td>
                    <td></td>
                    <td></td>
                </tr>
                        
                <tr>
                    <td class="table-image"></td>
                    <td></td>
                    <td></td>
                    <td class="small-caps table-bg" style="text-align: right">Tax</td>
                    <td>€{{ Cart::instance('default')->tax() }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                @if($used->notused == 0)
                    <td class="table-bg">€{{$total -= $codeValue}}</td>
                @elseif($used->notused == 1)
                    <td class="table-bg">€{{$total}}</td>
                    @endif

                <td class="column-spacer"></td>
                <td></td>
                </tr>

                </tbody>
            </table>
            <form action="{{url ('/checkVoucher')}}" method="post">
                {{csrf_field()}}
                <div class="input-group">
                    <div class="input-group-prepend">

                        @if($message->message != '')
                            <div class="alert alert-success" role="alert">
                                <span>{{$message->message}}</span>
                            </div>

                            @elseif($message->message == '')

                            @else
                            <div class="alert alert-danger" role="alert">
                                <span>{{$message->message}}</span>
                            </div>
                            @endif

                        <label class="input-group-text">Add your voucher code here:</label>
                    </div>
                    <input type="text" class="form-control" name="voucherCode">

                </div>



            </form>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;
            <form action="{{action('PayPalController@getExpressCheckout')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="name" value="
                @foreach(Cart::content() as $item)
                        {{$item->name}}
                @endforeach">
                <input type="hidden" name="price" value="{{Cart::instance('default')->subtotal()}}">
                <input type="hidden" name="qty" value="@foreach(Cart::content() as $item)
                {{$item->qty}}
                @endforeach">
                <input type="submit" value="send">
            </form>
            <a href="{{url('paypal/ec-checkout')}}" class="btn btn-success btn-lg">Proceed to Checkout</a>

            <div style="float:right">
                <form action="{{ url('/emptyCart') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger btn-lg" value="Empty Cart">
                </form>
            </div>

        @else

            <h3>You have no items in your shopping cart</h3>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a>

        @endif

        <div class="spacer"></div>

    </div> <!-- end container -->

@endsection

@section('cartupdate')
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                    type: "PATCH",
                    url: '{{ url("/cart") }}' + '/' + id,
                    data: {
                        'quantity': this.value,
                    },
                    success: function(data) {
                        window.location.href = '{{ url('/cart') }}';
                    }
                });

            });

        })();

    </script>
@endsection
