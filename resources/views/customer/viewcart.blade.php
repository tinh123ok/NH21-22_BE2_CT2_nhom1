@extends('customer.includes.master')
@section('content')


<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row tb" style="font-size: 18px;font-weight:bold;padding: 10px 0px;">
            <div class="col-md-2 col-xs-6">
                Ảnh Sản phẩm
            </div>
            <div class="col-md-3 col-xs-6">
                Tên Sản Phẩm
            </div>
            <div class="col-md-2 col-xs-6">
                Giá
            </div>
            <div class="col-md-2 col-xs-6">
                Số lượng
            </div>
            <div class="col-md-2 col-xs-6">
                Thao tác
            </div>
        </div>
        @foreach(\Gloudemans\Shoppingcart\Facades\Cart::getContent() as $key => $card)
        @php $product = (new \App\Helpers\Helper)->getproductbyid($card->id) @endphp

        <form id="form{{$key}}" action="" method="post">
            <div class="row tb" style="padding-top: 7px;">
                <div class="col-md-2 col-xs-6 ">
                    <img src="{{asset('img/'.$product->product_image)}}" width="100px" height="100px">
                </div>
                <div class="col-md-3 col-xs-6 ">
                {{$product->product_name}}
                </div>
                <div class="col-md-2 col-xs-6 ">
                {{number_format($product->product_price-$product->product_price*$product->product_sale/100)}}đ
                </div>
                <div class="col-md-2 col-xs-6">
                    <div style="width: 100px;">
                        <input type="hidden" name="id" value="{{$product->product_id}}">
                        <input name="soluong" data-urladd="" data-quantity="{{$card->quantity}}" value="{{$card->quantity}}" type="number" style="width: 100%;" placeholder="number" id="numPeople" />
                    </div>
                </div>
                <div style="margin-left: -10px;" class="col-md-2 col-xs-6 cart-btns1">
                    <a href="{{$product->product_id}}">Delete</a>
                </div>
            </div>
            <!-- /row -->
        </form>
        @endforeach
        <div class="row tb tt">
            <div class="col-md-5 col-xs-6"></div>
            <h4 class="col-md-2 col-xs-6" style="vertical-align: text-bottom;">Tổng Tiền:</h4>
            <div class="col-md-2 col-xs-6" style="font-size: 18px;font-weight:bold">{{number_format((new \App\Helpers\Helper)->total_arraycard())}} đ</div>
            <div class="col-md-2 col-xs-6 cart-btns1" style="margin-left: -10px;"> <a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection