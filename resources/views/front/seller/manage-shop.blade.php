@extends('front.seller.master.master')

@section('seller.title')
    Seller Manage Shop | {{$generalSettingView->site_name}}
@endsection

@section('seller.body')
    <div class="dashboard-profile mt-3">
        <div class="title">
            <h2>My Shop</h2>
            <span class="title-leaf"></span>
        </div>

        <div class="profile-tab dashboard-bg-box">
            <div class="dashboard-title dashboard-flex">
                <h3>Shop Information</h3>
            </div>

            <form action="{{route('seller.shop-update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="shop_id" value="{{$shop->id}}">
                <ul>
                    <li>
                        <h5>Shop Name:</h5>
                        <input type="text" class="form-control" value="{{$shop->shop_name}}" name="shop_name" placeholder="Enter shop name">
                    </li>
                    <li>
                        <h5>Address:</h5>
                        <textarea class="form-control" name="address" placeholder="Enter address">{{$shop->address}}</textarea>
                    </li>
                    <li>
                        <h5>Shop About:</h5>
                        <textarea class="form-control" name="shop_about" placeholder="Enter shop about">{{$shop->shop_about}}</textarea>
                    </li>
                    <li>
                        <h5>Logo:</h5>
                        <input type="file" class="form-control" name="logo">
                        @if(!empty($shop->logo))
                            <img src="{{asset($shop->logo)}}" alt="" style="height: 80px; width: 80px">
                        @endif
                    </li>
                    <li>
                        <h5>Banner:</h5>
                        <input type="file" class="form-control" name="banner">
                        @if(!empty($shop->banner))
                            <img src="{{asset($shop->banner)}}" alt="" style="height: 80px; width: 80px">
                        @endif
                    </li>
                    <li>
                        <h5>Phone:</h5>
                        <input type="text" class="form-control" value="{{$shop->phone}}" name="phone" placeholder="Enter phone number">
                    </li>
                    <li>
                        <h5>Facebook:</h5>
                        <input type="text" class="form-control" value="{{$shop->facebook}}" name="facebook" placeholder="Enter Facebook URL">
                    </li>
                    <li>
                        <h5>Twitter:</h5>
                        <input type="text" class="form-control" value="{{$shop->twitter}}" name="twitter" placeholder="Enter Twitter URL">
                    </li>
                    <li>
                        <h5>Google Map Url:</h5>
                        <input type="text" class="form-control" value="{{$shop->google}}" name="google" placeholder="Enter Google Map URL">
                    </li>
                    <li>
                        <h5>YouTube:</h5>
                        <input type="text" class="form-control" value="{{$shop->youtube}}" name="youtube" placeholder="Enter YouTube URL">
                    </li>
                    <li>
                        <h5>Meta Title:</h5>
                        <input type="text" class="form-control" value="{{$shop->meta_title}}" name="meta_title" placeholder="Enter meta title">
                    </li>
                    <li>
                        <h5>Meta Description:</h5>
                        <textarea class="form-control" name="meta_description" placeholder="Enter meta description">{{$shop->meta_description}}</textarea>
                    </li>
                </ul>
                <div class="dashboard-title dashboard-flex">
                    <button type="submit" class="btn btn-sm theme-bg-color text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
