@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - Privacy Policies
@endsection

@section('body')
    <div class="content-col">
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <hr style="border: solid dodgerblue 1px">
                    </div>
                    <div class="col-md-4">
                        <p class="text-center" style="font-size: 2em; color: dodgerblue">Privacy Policies</p>
                    </div>
                    <div class="col-md-4">
                        <hr style="border: solid dodgerblue 1px">
                    </div>
                </div>
                <div class="accordion accordion-rounded">
                    <p>{!! $privacy->privacy !!}</p>
                </div><!-- End .accordion -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </div>
@endsection
