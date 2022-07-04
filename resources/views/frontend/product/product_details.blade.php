@extends('layouts.app')

@section('content')
    @include('layouts.frontene_partials.collapse_nav')
    @php
    $review_5 = App\Models\review::where('product_id', $product->id)
        ->where('rating', 5)
        ->count();
    $review_4 = App\Models\review::where('product_id', $product->id)
        ->where('rating', 4)
        ->count();
    $review_3 = App\Models\review::where('product_id', $product->id)
        ->where('rating', 3)
        ->count();
    $review_2 = App\Models\review::where('product_id', $product->id)
        ->where('rating', 2)
        ->count();
    $review_1 = App\Models\review::where('product_id', $product->id)
        ->where('rating', 1)
        ->count();

    $sum_rating = App\Models\review::where('product_id', $product->id)->sum('rating');
    $count_rating = App\Models\review::where('product_id', $product->id)->count('rating');
    @endphp

    <!-- Single Product -->

    <div class="single_product">
        <div class="container">
            <div class="row">
                @php
                    $images = json_decode($product->images, true);
                    $color = explode(',', $product->color);
                    $size = explode(',', $product->size);
                @endphp
                <!-- Images -->
                <div class="col-lg-1 order-lg-1 order-2">
                    <ul class="image_list">
                        @isset($images)
                            @foreach ($images as $image)
                                <li data-image="{{ asset('files/products/' . $image) }}"><img
                                        src="{{ asset('files/products/' . $image) }}" alt=""></li>
                            @endforeach
                        @endisset
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ asset('files/products/' . $product->thumbnail) }}"
                            alt="">
                    </div>
                </div>

                <!-- Description -->
                <div class="col-lg-3 order-3">
                    <div class="product_description">
                        <div class="product_category">{{ $product->category->category_name }} <strong>>></strong>
                            {{ $product->subcategory->subcategory_name }}</div>
                        <div class="product_name">{{ $product->name }}</div>
                        <div class="product_name" style="font-size: 15px">Brand:{{ $product->brand->brand_name }}</div>
                        <div class="product_name" style="font-size: 15px">Stock:{{ $product->stock_quantity }}</div>
                        <div class="product_name" style="font-size: 15px">Unit:{{ $product->unit }}</div>
                        <div class="rating_r rating_r_4 product_rating"></div>
                        <div class="product_text">
                            <p>{{ $product->description }}</p>
                        </div>
                        <div>
                            @if ($sum_rating != null)
                                @if (intval($sum_rating / $count_rating) == 5)
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                @elseif(intval($sum_rating / $count_rating) >= 4 && intval($sum_rating / $count_rating) < $count_rating)
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                @elseif(intval($sum_rating / $count_rating) >= 3 && intval($sum_rating / $count_rating) < 4)
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                @elseif(intval($sum_rating / $count_rating) >= 2 && intval($sum_rating / $count_rating) < 3)
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                @else
                                    <span><i class="fa fa-star checked"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                @endif
                            @endif
                        </div>
                        @if ($product->discount_price == null)
                            <div class="banner_price">{{ $setting->currency }}{{ $product->selling_price }}
                            </div>
                        @else
                            <div class="banner_price">
                                <span>{{ $setting->currency }}{{ $product->selling_price }}</span>{{ $setting->currency }}{{ $product->discount_price }}
                            </div>
                        @endif
                        <div class="order_info d-flex flex-row">
                            <form>
                                <div class="row">
                                    @isset($product->size)
                                        <div class="col-6">
                                            <label for="">Size</label>
                                            <select name="size" class="form-control" style="width: 170px">
                                                @foreach ($size as $row)
                                                    <option value="">{{ $row }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endisset
                                    @isset($product->color)
                                        <div class="col-6">
                                            <label for="">Color</label>
                                            <select name="color" class="form-control" style="width: 170px">
                                                @foreach ($color as $row)
                                                    <option value="">{{ $row }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endisset
                                </div>
                                <div class="clearfix" style="z-index: 1000;">
                                    <!-- Product Quantity -->
                                    <div class="product_quantity clearfix">
                                        <span>Quantity: </span>
                                        <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i
                                                    class="fas fa-chevron-up"></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i
                                                    class="fas fa-chevron-down"></i></div>
                                        </div>
                                    </div>

                                    <!-- Product Color -->
                                    <ul class="product_color">
                                        <li>
                                            <span>Color: </span>
                                            <div class="color_mark_container">
                                                <div id="selected_color" class="color_mark"></div>
                                            </div>
                                            <div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

                                            <ul class="color_list">
                                                <li>
                                                    <div class="color_mark" style="background: #999999;"></div>
                                                </li>
                                                <li>
                                                    <div class="color_mark" style="background: #b19c83;"></div>
                                                </li>
                                                <li>
                                                    <div class="color_mark" style="background: #000000;"></div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                </div>
                                <div class="button_container">
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        @if ($product->stock_quantity < 1)
                                            <button type="submit" class="btn btn-danger mr-2">Stock Out</button>
                                        @else
                                            <button type="submit" class="btn btn-primary mr-2"> Add to cart</button>
                                        @endif
                                        <a href="{{ route('add.wishlist', $product->id) }}" type="button"
                                            class="btn btn-primary">Wishlist</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Description -->
                <div class="col-lg-4 order-3">
                    <div class="aditionnal-info">
                        <h3><strong>Pickpoint of this product</strong></h3>
                        <i class="fa fa-map"> {{ $product->pickup_point->pickup_point_name }}</i><br>
                        <i class="fa fa-map"> {{ $product->pickup_point->pickup_point_address }}</i>
                        <strong>Home Delivery</strong>
                        <span>Cash on Delivery</span>
                        <strong>Product Video</strong>
                        @isset($product->video)
                            <iframe width="100%" height="200"
                                src="https://www.youtube.com/embed/{{ $product->video }}" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        @endisset
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product Details of {{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ratings & Reviews of {{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    Average Review of <strong>{{ $product->name }}</strong> <br>
                                    @if ($sum_rating != null)
                                        @if (intval($sum_rating / $count_rating) == 5)
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                        @elseif(intval($sum_rating / $count_rating) >= 4 && intval($sum_rating / $count_rating) < $count_rating)
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        @elseif(intval($sum_rating / $count_rating) >= 3 && intval($sum_rating / $count_rating) < 4)
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        @elseif(intval($sum_rating / $count_rating) >= 2 && intval($sum_rating / $count_rating) < 3)
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        @else
                                            <span><i class="fa fa-star checked"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-3">
                                    Total Review of <strong>{{ $product->name }}</strong> <br>

                                    <div>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span>{{ $review_5 }}</span>
                                    </div>
                                    <div>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span>{{ $review_4 }}</span>
                                    </div>
                                    <div>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span>{{ $review_3 }}</span>
                                    </div>
                                    <div>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span>{{ $review_2 }}</span>
                                    </div>
                                    <div>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span><i class="fa-regular fa-star"></i></span>
                                        <span>{{ $review_1 }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('store.review') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="details">Write Your Review</label>
                                            <textarea type="text" class="form-control" name="review" required=""></textarea>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="form-group ">
                                            <label for="review">Write Your Review</label>
                                            <select class="custom-select form-control-sm" name="rating"
                                                style="min-width: 120px;">
                                                <option disabled="" selected="">Select Your Review</option>
                                                <option value="1">1 star</option>
                                                <option value="2">2 star</option>
                                                <option value="3">3 star</option>
                                                <option value="5">4 star</option>
                                                <option value="5">5 star</option>
                                            </select>

                                        </div>
                                        @if (Auth::check())
                                            <button type="submit" class="btn btn-sm btn-info"><span
                                                    class="fa fa-star "></span> submit review</button>
                                        @else
                                            <p>Please at first login to your account for submit a review.</p>
                                        @endif
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($review as $row)
                                    <div class="card  col-6">
                                        <div class="card-header">
                                            {{ $row->user->name }} ( {{ date('d F,Y'), strtotime($row->review_date) }}
                                            )
                                        </div>
                                        <div class="card-body">
                                            {{ $row->review }}
                                            @if ($row->rating == 5)
                                                <div>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                </div>
                                            @elseif ($row->rating == 4)
                                                <div>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                </div>
                                            @elseif ($row->rating == 3)
                                                <div>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                </div>
                                            @elseif ($row->rating == 2)
                                                <div>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                </div>
                                            @elseif ($row->rating == 1)
                                                <div>
                                                    <span><i class="fa fa-star"></i></span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Related Product</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">

                            <!-- Recently Viewed Item -->
                            @foreach ($relatedproduct as $row)
                                <div class="owl-item">
                                    <div
                                        class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image"><img
                                                src="{{ asset('files/products/' . $row->thumbnail) }}"
                                                alt="{{ $row->name }}"></div>
                                        <div class="viewed_content text-center">
                                            @if ($row->discount_price == null)
                                                <div class="banner_price">
                                                    {{ $setting->currency }}{{ $row->selling_price }}</div>
                                            @else
                                                <div class="banner_price">
                                                    <span>{{ $setting->currency }}{{ $row->selling_price }}</span>{{ $setting->currency }}{{ $row->discount_price }}
                                                </div>
                                            @endif
                                            <div class="viewed_name"><a
                                                    href="{{ route('product.details', $row->slug) }}">{{ substr($row->name, 0, 30) }}</a>
                                            </div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_discount">new</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
