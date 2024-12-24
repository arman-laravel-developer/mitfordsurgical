@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - Terms and Conditions
@endsection

@section('body')
    <style>
        .page-content {
            margin-top: 15%;
        }

        @media (max-width: 768px) {
            .page-content {
                margin-top: 30%;
            }
        }
    </style>
    <div class="content-col">
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <hr style="border: solid dodgerblue 1px">
                    </div>
                    <div class="col-md-4">
                        <p class="text-center" style="font-size: 2em; color: dodgerblue">Terms and conditions</p>
                    </div>
                    <div class="col-md-4">
                        <hr style="border: solid dodgerblue 1px">
                    </div>
                </div>
                <div class="accordion accordion-rounded">
                    <p>{!! $condition->condition !!}</p>
                </div><!-- End .accordion -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </div>
@endsection
