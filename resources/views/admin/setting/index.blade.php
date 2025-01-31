@extends('admin.master')
@section('title')
    Website Settings | {{env('APP_NAME')}}
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
                <h4 class="page-title">Website Settings</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0">
                    <h4>Site Information</h4>
                </div>
                <div class="card-body" style="padding-top: 0">
                    <form action="{{route('setting.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-1">
                            <label class="col-form-label">Site Name</label>
                            <input type="text" class="form-control @error('site_name') is-invalid @enderror" value="{{optional($generalSetting)->site_name}}" name="site_name" placeholder="Site name"/>
                            @error('site_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">WhatsApp url</label>
                            <input type="tel" class="form-control @error('pinterest_url') is-invalid @enderror" value="{{optional($generalSetting)->pinterest_url}}" name="pinterest_url" placeholder="+8801xxxxxxxxx"/>
                            @error('pinterest_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Favicon</label>
                            <input type="file" class="form-control @error('favicon') is-invalid @enderror" name="favicon" accept="ico" id="favicon"/>
                            <img id="faviconPreview" class="mt-1" src="{{asset(optional($generalSetting)->favicon)}}" alt="Preview" style="max-width: 200px; max-height: 200px;">
                            @error('favicon')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0">
                    <h4>Site Seo</h4>
                </div>
                <div class="card-body" style="padding-top: 0">
                    <form action="{{route('setting.update-site-seo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="general_setting_id" value="{{optional($generalSetting)->id}}">
                        <div class="row mb-1">
                            <label class="col-form-label">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" value="{{optional($generalSetting->siteSeo->first())->meta_title}}" name="meta_title" placeholder="Meta Title"/>
                            @error('meta_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Meta Description</label>
                            <textarea type="text" style="height: 150px" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" placeholder="Meta Description">{{optional($generalSetting->siteSeo->first())->meta_description}}</textarea>
                            @error('meta_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label" style="font-size: 90%">Tags<sup class="text-danger">*</sup></label>
                            <div class="">
                                <input type="text" id="tagsInput" value="{{optional($generalSetting->siteSeo->first())->keywords}}" class="form-control @error('tags') is-invalid @enderror" autocomplete="off"/>
                                <div id="tagsContainer" class="mt-2"></div>
                                <input type="hidden" name="tags" value="{{optional($generalSetting->siteSeo->first())->keywords}}" id="tagsHiddenInput">
                                @error('tags')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label">Site Seo Image</label>
                            <input type="file" class="form-control @error('site_seo_image') is-invalid @enderror" name="site_seo_image" id="siteSeoImage"/>
                            <img id="siteSeoImagePreview" class="mt-1" src="{{asset(optional($generalSetting->siteSeo->first())->meta_image)}}" alt="Preview" style="max-width: 200px; max-height: 200px;">
                            @error('header_logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
        function previewSiteSeoImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var siteSeoImagePreview = document.getElementById('siteSeoImagePreview');
                siteSeoImagePreview.src = reader.result;
                siteSeoImagePreview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }

        var siteSeoImage = document.getElementById('siteSeoImage');
        siteSeoImage.addEventListener('change', previewSiteSeoImage);
    </script>
    <script>
        function previewFooterImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var footerLogoPreview = document.getElementById('footerLogoPreview');
                footerLogoPreview.src = reader.result;
                footerLogoPreview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }

        var footerLogo = document.getElementById('footerLogo');
        footerLogo.addEventListener('change', previewFooterImage);
    </script>
    <script>
        function previewFaviconImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var faviconPreview = document.getElementById('faviconPreview');
                faviconPreview.src = reader.result;
                faviconPreview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }

        var favicon = document.getElementById('favicon');
        favicon.addEventListener('change', previewFaviconImage);
    </script>
    <script>
        function previewPaymentImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var paymentPreview = document.getElementById('paymentPreview');
                paymentPreview.src = reader.result;
                paymentPreview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }

        var payment_method_image = document.getElementById('payment_method_image');
        payment_method_image.addEventListener('change', previewPaymentImage);
    </script>

    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 300
        });
    </script>
    <!-- end row -->

    <script>
        var tags = [];

        document.getElementById('tagsInput').addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === 'Tab' || event.key === ',') {
                event.preventDefault(); // Prevent form submission or focus change
                var input = this.value.trim();

                if (input && !tags.includes(input)) {
                    addTag(input);
                    this.value = ''; // Clear the input field
                }
            }
        });

        // Handling paste event to split text into tags
        document.getElementById('tagsInput').addEventListener('paste', function (event) {
            event.preventDefault(); // Prevent the default paste behavior
            var paste = event.clipboardData.getData('text');
            var tagsArray = paste.split(',').map(tag => tag.trim()).filter(tag => tag); // Split by comma and trim whitespace

            tagsArray.forEach(tag => {
                if (!tags.includes(tag)) {
                    addTag(tag);
                }
            });

            this.value = ''; // Clear the input field after pasting
        });

        function addTag(tagText) {
            var tagsContainer = document.getElementById('tagsContainer');
            tags.push(tagText);
            updateHiddenInput();

            var tag = document.createElement('div');
            tag.classList.add('tag');
            tag.textContent = tagText;

            var removeBtn = document.createElement('span');
            removeBtn.textContent = 'x';
            removeBtn.addEventListener('click', function () {
                tagsContainer.removeChild(tag);
                removeTag(tagText);
            });

            tag.appendChild(removeBtn);
            tagsContainer.appendChild(tag);
        }

        function removeTag(tagText) {
            tags = tags.filter(function(tag) {
                return tag !== tagText;
            });
            updateHiddenInput();
        }

        function updateHiddenInput() {
            document.getElementById('tagsHiddenInput').value = tags.join(',');
        }
    </script>



@endsection



