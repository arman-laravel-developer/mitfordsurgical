@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('Return And Refund Policies')}}
@endsection

@section('seo')
    <meta name="description" content="Learn more about {{$generalSettingView->site_name}}. Return & Refund Policy">
    <meta name="keywords" content="{{$generalSettingView->site_name}}, Return & Refund Policy, Contact Us, Return & Refund Policy, Privacy Policy">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{request()->url()}}">

    <!-- Open Graph (OG) Meta Tags for Social Media -->
    <meta property="og:title" content="Return & Refund Policy - {{$generalSettingView->site_name}}">
    <meta property="og:description" content="Learn more about Return & Refund Policy at {{$generalSettingView->site_name}}.">
    <meta property="og:image" content="{{asset($generalSettingView->header_logo)}}">
    <meta property="og:url" content="{{request()->url()}}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{$generalSettingView->site_name}}">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Return & Refund Policy - {{$generalSettingView->site_name}}">
    <meta name="twitter:description" content="Find out more about Return & Refund Policy at {{$generalSettingView->site_name}}.">
    <meta name="twitter:image" content="{{asset($generalSettingView->header_logo)}}">
    <meta name="twitter:site" content="@mitfordsurgical">
    <meta name="twitter:creator" content="@mitfordsurgical">
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
                    <div class="col-md-3">
                        <hr style="border: solid dodgerblue 1px">
                    </div>
                    <div class="col-md-6">
                        <p class="text-center" style="font-size: 2em; color: dodgerblue">{{translate('Return And Refund Policies')}}</p>
                    </div>
                    <div class="col-md-3">
                        <hr style="border: solid dodgerblue 1px">
                    </div>
                </div>
                <div class="accordion accordion-rounded">
                    <p>{!! $return->getTranslation('return') !!}</p>
                </div><!-- End .accordion -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </div>
@endsection
