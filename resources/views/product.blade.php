@extends('master')

@section('seo_title')
    @if(!$product->seo_title)
        {{title_case($product->name)}}
    @else
        {{title_case($product->seo_title)}}
    @endif
@endsection
@section('meta_description')
    @if(!$product->meta_description)
        {{$product->excerpt}}
    @else
        {{$product->meta_description}}
    @endif
@endsection
@section('meta_keywords',$product->meta_keywords)

@section('content')
    @php
        $the_product_category = $product_categories->where('id',$product->product_category_id)->first();
    @endphp
    <div class="area content bg-white fullwidth">
        <div class="grid-container grid-parent">
            <nav class="breadcrumbs grid-75 push-25 tablet-grid-75 tablet-push-25 mobile-grid-100">
                <ul>
                    <li><a href="/">{{__('main.home')}}</a></li>
                    <li><a href="/products">{{__('main.products')}}</a></li>
                    <li>
                        <a href="/products/{{$the_product_category->slug}}">{{title_case($the_product_category->name)}}</a>
                    </li>
                    <li>
                        <a href="/products/{{$the_product_category->slug}}/{{$product->slug}}">{{title_case($product->name)}}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="area content bg-white">
        <div class="grid-container">
            <div class="content-column grid-75 push-25 tablet-grid-75 tablet-push-25 mobile-grid-100 grid-parent">
                <div class="csc-default">
                    <h1 class="first">{{title_case($product->name)}}</h1>

                    <ul class="tabs">
                        <li class="current"><a
                                    href="/products/{{$the_product_category->slug}}/{{$product->slug}}">{{__('main.features_options')}}</a>
                        </li>
                        {{-- <li>
                            <a href="/products/{{$the_product_category->slug}}/{{$product->slug}}/models">{{__('main.downloads')}}</a>
                        </li> --}}
                    </ul>

                    <div class="product_details grid-parent tab-content">
                        <div class="grid-parent grid-66 tablet-grid-66 mobile-grid-100">
                            <div class="grid-50 tablet-grid-50 mobile-grid-100 grid-parent pdf_form_container">
                                <a href="/inquiry?product_name={{$product->name}}&cas={{$product->cas}}&product_id={{$product->id}}"
                                   class="btn btn-block glyphicons glyphicons-message-empty">{{__('main.request_a_quote')}}</a>
                            </div>
                            <div class="grid-50 tablet-grid-50 mobile-grid-100 grid-parent">
                                <div data-id="905ac06123"
                                     class="livechat_button btn btn-block glyphicons glyphicons-message-empty"><a
                                            href="https://www.livechatinc.com/customer-service-software/?utm_source=chat_button&utm_medium=referral&utm_campaign=lc_10065598">Live
                                        Chat Now !</a></div>
                            </div>
                        </div>

                        <div class="side">
                            <div class="mediaContainer">
                                <div class="media">
                                    @if($product->images)
                                        @foreach(json_decode($product->images) as $product_image)
                                            <a class="image zoom" href="{{Voyager::image($product_image)}}"
                                               data-id="{{Voyager::image($product_image)}}" rel="product_images">
                                                <picture>
                                                    <img src="{{Voyager::image($product_image)}}"
                                                         data-id="{{Voyager::image($product_image)}}">
                                                </picture>
                                            </a>
                                        @endforeach
                                    @endif
                                    <div class="zoomIcon"></div>
                                </div>

                                <div class="thumbnails image">
                                    @if($product->images)
                                        @foreach(json_decode($product->images) as $product_image)
                                            <picture>
                                                <img src="{{Voyager::image($product_image)}}"
                                                     data-id="{{Voyager::image($product_image)}}">
                                            </picture>
                                        @endforeach
                                    @endif
                                </div>
                                {{--<div class="thumbnails video">--}}
                                {{--<picture>--}}
                                {{--<img src="images/content/b8e5b2f639bad9e8ba8b5a3c9ec4b5d2.jpg"--}}
                                {{--data-id="https://www.youtube.com/embed/wgqNXP4Ia6w"--}}
                                {{--class="zoom video">--}}
                                {{--</picture>--}}
                                {{--<picture>--}}
                                {{--<img src="images/content/78e0ff561805404782b589b06aee0cb4.gif"--}}
                                {{--data-id="https://www.youtube.com/embed/o2zUJOrKMjo"--}}
                                {{--class="zoom video">--}}
                                {{--</picture>--}}
                                {{--</div>--}}
                            </div>
                        </div>

                        {!! $product->body !!}

                        <div class="grid-33 tablet-grid-33 mobile-grid-100 grid-parent pdf_form_container">
                            <a href="/inquiry?product_name={{$product->name}}&cas={{$product->cas}}&product_id={{$product->id}}"
                               class="btn btn-block glyphicons glyphicons-message-empty">{{__('main.request_a_quote')}}</a>
                        </div>
                        <div class="grid-33 tablet-grid-33 mobile-grid-100 grid-parent pdf_form_container">
                            <div data-id="905ac06123"
                                 class="livechat_button btn btn-block glyphicons glyphicons-message-empty"><a
                                        href="https://www.livechatinc.com/customer-service-software/?utm_source=chat_button&utm_medium=referral&utm_campaign=lc_10065598">Live
                                    Chat Now !</a></div>
                        </div>

                        <hr>
                        <h3>{{title_case(__('main.quickly_search'))}}</h3>
                        @component('component.search_form')
                        @endcomponent

                    </div>
                    <div class="tab-loading"></div>
                </div>
            </div>
            <div class="sidebar-column grid-25 pull-75 tablet-grid-25 tablet-pull-75 grid-parent">
                <nav class="nav">
                    <ul>
                        <li><a href="/products">Products</a>
                        @foreach($product_categories as $product_category)
                            <li @if(str_contains(url()->current(),$product_category->slug)) class="active" @endif><a
                                        href="/products/{{$product_category->slug}}">{{title_case($product_category->name)}}</a>
                                @if(str_contains(url()->current(),$product_category->slug))
                                    <ul>
                                        @foreach($products as $product)
                                            <li @if(str_contains(url()->current(),$product->slug)) class="active" @endif>
                                                <a href="/products/{{$product_category->slug}}/{{$product->slug}}">{{title_case($product->name)}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <div class="tagcloud-container content"></div>
            </div>
        </div>
    </div>
@endsection