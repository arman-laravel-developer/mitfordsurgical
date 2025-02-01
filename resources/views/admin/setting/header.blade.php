@extends('admin.master')
@section('title')
    Header | {{env('APP_NAME')}}
@endsection

@section('body')
    <style>
        #tagsContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .tag {
            background-color: #e0e0e0;
            padding: 5px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
        }

        .tag span {
            margin-left: 10px;
            cursor: pointer;
            font-size: 12px;
        }
    </style>
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
                <h4 class="page-title">Header</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0">
                    <h4>Header Information</h4>
                </div>
                <div class="card-body" style="padding-top: 0">
                    <form action="{{route('setting.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Header Logo</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control @error('header_logo') is-invalid @enderror" name="header_logo" id="headerLogo"/>
                                <img id="headerLogoPreview" class="mt-1" src="{{asset(optional($generalSetting)->header_logo)}}" alt="Preview" style="max-width: 200px; max-height: 200px;">
                            </div>
                            @error('header_logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-md-3 col-form-label">Show Language Change?</label>
                            <div class="col-md-9">
                                <input type="checkbox" id="switch1" value="1" class="form-control" name="language_change" data-switch="bool"/>
                                <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <script>
        function previewHeaderImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var headerLogoPreview = document.getElementById('headerLogoPreview');
                headerLogoPreview.src = reader.result;
                headerLogoPreview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }

        var headerLogo = document.getElementById('headerLogo');
        headerLogo.addEventListener('change', previewHeaderImage);
    </script>

    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 300
        });
    </script>
    <!-- end row -->



@endsection



