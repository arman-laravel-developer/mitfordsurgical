@extends('admin.master')
@section('title')
    Privacy & Policy Edit | {{env('APP_NAME')}}
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
                <h4 class="page-title">Privacy & Policy Edit</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-fill border-primary mb-3">
                        @foreach (\App\Models\Language::all() as $key => $language)
                            <li class="nav-item">
                                <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('privacy.add', ['id'=>$privacy->id, 'lang'=> $language->code] ) }}">
                                    <img src="{{ asset('admin/assets/images/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                                    <span>{{$language->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="basic-form-preview">
                            <form action="{{route('privacy.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$lang}}" name="lang">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-md-2 col-form-label">Privacy & Policy</label>
                                    <div class="col-md-10">
                                        <textarea type="text" id="summernote" name="privacy" class="form-control @error('privacy') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Enter privacy">{{optional($privacy)->getTranslation('privacy',request()->lang)}}</textarea>
                                        @error('privacy')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-md-2 col-form-label">Condition</label>
                                    <div class="col-md-10">
                                        <textarea type="text" id="summernote2" name="condition" class="form-control @error('condition') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Enter condition">{{optional($privacy)->getTranslation('condition',request()->lang)}}</textarea>
                                        @error('condition')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-2 col-form-label"></label>
                                    <div class="col-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 300
        });

        $('#summernote2').summernote({
            tabsize: 2,
            height: 300
        });
    </script>

@endsection



