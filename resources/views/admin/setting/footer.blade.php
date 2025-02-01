@extends('admin.master')
@section('title')
    Footer | {{env('APP_NAME')}}
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
                <h4 class="page-title">Footer</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0">
                    <h4>Footer Information</h4>
                </div>
                <div class="card-body" style="padding-top: 0">
                    <form action="{{route('setting.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-1">
                            <label class="col-form-label">Footer Mobile</label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" value="{{optional($generalSetting)->mobile}}" name="mobile" placeholder="Footer mobile"/>
                            @error('mobile')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Footer email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{optional($generalSetting)->email}}" name="email" placeholder="Footer email"/>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Footer address</label>
                            <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Footer address">{{optional($generalSetting)->address}}</textarea>
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">About Us Footer</label>
                            <textarea type="text" class="form-control @error('about_us_short') is-invalid @enderror" name="about_us_short" placeholder="About us">{{optional($generalSetting)->about_us_short}}</textarea>
                            @error('about_us_short')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Facebook url</label>
                            <input type="text" class="form-control @error('facebook_url') is-invalid @enderror" value="{{optional($generalSetting)->facebook_url}}" name="facebook_url" placeholder="facebook url"/>
                            @error('facebook_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Instagram url</label>
                            <input type="text" class="form-control @error('instagram_url') is-invalid @enderror" value="{{optional($generalSetting)->instagram_url}}" name="instagram_url" placeholder="instagram url"/>
                            @error('instagram_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Youtube url</label>
                            <input type="text" class="form-control @error('youtube_url') is-invalid @enderror" value="{{optional($generalSetting)->youtube_url}}" name="youtube_url" placeholder="youtube url"/>
                            @error('youtube_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Twitter url</label>
                            <input type="text" class="form-control @error('twitter_url') is-invalid @enderror" value="{{optional($generalSetting)->twitter_url}}" name="twitter_url" placeholder="twitter url"/>
                            @error('twitter_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">LinkedIn url</label>
                            <input type="text" class="form-control @error('linkedin_url') is-invalid @enderror" value="{{optional($generalSetting)->linkedin_url}}" name="linkedin_url" placeholder="linkedIn url"/>
                            @error('linkedin_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-1">
                            <label class="col-form-label">Footer Logo</label>
                            <input type="file" class="form-control @error('footer_logo') is-invalid @enderror" name="footer_logo" id="footerLogo"/>
                            <img id="footerLogoPreview" class="mt-1" src="{{asset(optional($generalSetting)->footer_logo)}}" alt="Preview" style="max-width: 200px; max-height: 200px;">
                            @error('footer_logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label">Payment method footer image</label>
                            <input type="file" class="form-control @error('payment_method_image') is-invalid @enderror" name="payment_method_image" id="payment_method_image"/>
                            <img id="paymentPreview" class="mt-1" src="{{asset(optional($generalSetting)->payment_method_image)}}" alt="Preview" style="max-width: 200px; max-height: 200px;">
                            @error('payment_method_image')
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



