@extends('admin.master')
@section('title')
    Language Add | {{env('APP_NAME')}}
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
                <h4 class="page-title">Language Add</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="basic-form-preview">
                            <form action="{{route('language.new')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-form-label">Name</label>
                                    <div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputEmail3" placeholder="Name"/>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-form-label">Code</label>
                                    <div>
                                        @php
                                            use Illuminate\Support\Facades\File;

                                            // Define the server-side path to the flags directory
                                            $flagsPath = public_path('admin/assets/images/flags');
                                            $languagesArray = \App\Models\Language::pluck('code')->toArray();
                                        @endphp
                                        <select class="form-control" name="code" data-bs-toggle="select2">
                                            @if(File::exists($flagsPath))
                                                @foreach(File::files($flagsPath) as $path)
                                                    @php
                                                        $fileName = pathinfo($path)['filename'];
                                                    @endphp
                                                    <option value="" disabled selected>Select Language Code</option>
                                                    @if(!in_array($fileName, $languagesArray))
                                                        <option value="{{ $fileName }}" data-image="{{ asset('admin/assets/images/flags/'.$fileName.'.png') }}">
                                                            <span>{{ strtoupper($fileName) }}</span>
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="">No flags found</option>
                                            @endif
                                        </select>
                                        @error('code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="app_lang_code" class="col-form-label">Flutter App Lang Code</label>
                                    <code><a target="_blank" href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">{{ translate("Links for ISO 639-1 codes")}}</a></code>
                                    <div>
                                        <input type="text" class="form-control @error('app_lang_code') is-invalid @enderror" name="app_lang_code" id="app_lang_code" placeholder="{{translate('Put ISO 639-1 code for your language')}}"/>
                                        @error('app_lang_code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-form-label"></label>
                                    <div>
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
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 300
        });

        $(document).ready(function() {
            $('select[name="code"]').select2({
                placeholder: "Search language...",
                allowClear: true, // Enables clear button
                templateResult: formatFlagOption, // Customize display with flags
                templateSelection: formatFlagOption // Customize selected item
            });
        });

        function formatFlagOption(option) {
            if (!option.id) {
                return option.text; // Return the text for placeholder
            }
            var imgUrl = $(option.element).data('image');
            return $(
                '<span><img src="' + imgUrl + '" class="img-flag" style="width: 20px; margin-right: 5px;" /> ' + option.text + '</span>'
            );
        }

    </script>
    <!-- end row -->



@endsection



