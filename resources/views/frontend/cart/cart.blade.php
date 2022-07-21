@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">
@include('layouts.frontene_partials.collapse_nav')
    

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach ($content as $row)
                            @php
                                $product = DB::table('products')->where('id',$row->id)->first();
                                $color = explode(',', $product->color);
                                $sizes = explode(',', $product->size);
                            @endphp
                            <li class="cart_item clearfix">
                                <div class="cart_item_image">
                                    <img src="{{ asset('files/products/'.$row->options->thumbnail) }}" alt="{{ $row->name }}">
                                </div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_text">{{ $row->name }}</div>
                                    </div>
                                    @if($row->options->size !=null)
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_text">
                                            <select class="custom-select form-control-sm size" name="size" data-id="{{ $row->rowId }}"
                                            style="min-width: 120px; margin-left: -4px;">
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size }}" @if($size==$row->options->size) selected  @endif>{{ $size }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if($row->options->color !=null)
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_text">
                                            <select class="custom-select form-control-sm color" data-id="{{ $row->rowId }}" name="color"
                                            style="min-width: 120px; margin-left: -4px;">
                                            @foreach ($color as $color)
                                            <option value="{{ $color }}" @if($color==$row->options->color) selected  @endif>{{ $color }}</option>
                                        @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_text ">
                                            <input type="number" data-id="{{ $row->rowId }}" class="form-control-sm qty" name="qty" value="{{ $row->qty }}" min="1" required>
                                        </div>
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_text">{{ $setting->currency }}{{ $row->price }}x{{ $row->qty }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_text">{{ $setting->currency }}{{ $row->price*$row->qty }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_text text-danger"><span style="cursor: pointer"><a href="" data-id="{{ $row->rowId }}" id="removeproduct">X</a></span></div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                                        
                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">{{ $setting->currency }}{{ Cart::total() }}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{ route('cart.empty') }}" class="button cart_button_clear btn-danger">Empty Cart</a>
                        <button type="button" class="button cart_button_checkout">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $('body').on('click', '#removeproduct', function() {
        let id = $(this).data('id');
        $.ajax({
            url:'{{ url('cartproduct/remove/') }}/'+id,
            type:'get',
            success:function(data){
                toastr.success(data);
                location.reload();
            }
        })
    })
    //quantity
    $('body').on('blur', '.qty', function() {
        let qty = $(this).val();
        let rowId=$(this).data('id');
        // alert(rowId);
        $.ajax({
            url:'{{ url('cartproduct/updateqty/') }}/'+rowId+'/'+qty,
            type:'get',
            success:function(data){
                toastr.success(data);
                location.reload();
            }
        })
    })
    //color
    $('body').on('change', '.color', function() {
        let color = $(this).val();
        let rowId=$(this).data('id');
        // alert(rowId);
        $.ajax({
            url:'{{ url('cartproduct/updatecolor/') }}/'+rowId+'/'+color,
            type:'get',
            success:function(data){
                toastr.success(data);
                location.reload();
            }
        })
    })
    //size
    $('body').on('change', '.size', function() {
        let size = $(this).val();
        let rowId=$(this).data('id');
        // alert(rowId);
        $.ajax({
            url:'{{ url('cartproduct/updatesize/') }}/'+rowId+'/'+size,
            type:'get',
            success:function(data){
                toastr.success(data);
                location.reload();
            }
        })
    })
</script>

@endsection