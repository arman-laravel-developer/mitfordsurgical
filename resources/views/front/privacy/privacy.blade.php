@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('Privacy Policies')}}
@endsection

@section('body')
    <style>
        .page-content {
            margin-top: 10%;
        }

        @media (max-width: 768px) {
            .page-content {
                margin-top: 20%;
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
                        <p class="text-center" style="font-size: 2em; color: dodgerblue">{{translate('Privacy Policies')}}</p>
                    </div>
                    <div class="col-md-4">
                        <hr style="border: solid dodgerblue 1px">
                    </div>
                </div>
                <div class="accordion accordion-rounded">
                    <p>{!! $privacy->getTranslation('privacy') !!}</p>
                </div><!-- End .accordion -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </div>
@endsection
