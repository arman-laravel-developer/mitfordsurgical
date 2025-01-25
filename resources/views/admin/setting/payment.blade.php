@extends('admin.master')
@section('title')
    Payment Method | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                                    <i class="mdi mdi-calendar-range font-13"></i>
                                                </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Payment Method</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="margin-bottom: 0;">
                    <h4>Bkash Credential</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('setting.payment-update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class=" col-form-label">BKASH_APP_KEY</label>
                            <div class="">
                                <input type="text" name="BKASH_APP_KEY" value="{{ env('BKASH_APP_KEY') }}" class="form-control @error('BKASH_APP_KEY') is-invalid @enderror">
                                @error('BKASH_APP_KEY')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class=" col-form-label">BKASH_APP_SECRET</label>
                            <div class="">
                                <input type="text" name="BKASH_APP_SECRET" value="{{ env('BKASH_APP_SECRET') }}" class="form-control @error('BKASH_APP_SECRET') is-invalid @enderror">
                                @error('BKASH_APP_SECRET')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class=" col-form-label">BKASH_USERNAME</label>
                            <div class="">
                                <input type="text" name="BKASH_USERNAME" value="{{ env('BKASH_USERNAME') }}" class="form-control @error('BKASH_USERNAME') is-invalid @enderror">
                                @error('BKASH_USERNAME')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class=" col-form-label">BKASH_PASSWORD</label>
                            <div class="">
                                <input type="text" name="BKASH_PASSWORD" value="{{ env('BKASH_PASSWORD') }}" class="form-control @error('BKASH_PASSWORD') is-invalid @enderror">
                                @error('BKASH_PASSWORD')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" value="{{$generalSettingView->id}}" name="setting_id">
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-form-label">Sandbox Mode</label>
                            <div>
                                <input type="checkbox" id="switch1" class="form-control" value="1" @if($generalSettingView->sandbox_mode == 1) checked @endif name="sandbox_mode" data-switch="bool"/>
                                <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class=" col-form-label"></label>
                            <div class="">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection




