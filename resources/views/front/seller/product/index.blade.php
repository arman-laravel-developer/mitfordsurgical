@extends('front.seller.master.master')

@section('seller.title')
    Seller Product Add | {{$generalSettingView->site_name}}
@endsection

@section('seller.body')
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
    <div class="row mt-4">
        <div class="col-lg-12">
            <form action="{{route('seller-product.new')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -4%;">
                                <h4>Product Information</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" style="font-size: 90%">Product Name<sup class="text-danger">*</sup></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Product name" required/>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" style="font-size: 90%">Category<sup class="text-danger">*</sup></label>
                                    <div class="col-md-9">
                                        <select name="category_id" id="" class="selectpicker form-control @error('category_id') is-invalid @enderror" data-live-search="true" required>
                                            @php echo $categories_dropdown @endphp
                                        </select>
                                        @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" style="font-size: 90%">Brand</label>
                                    <div class="col-md-9">
                                        <select name="brand_id" id="" class="selectpicker form-control @error('brand_id') is-invalid @enderror" data-live-search="true">
                                            <option value="" selected disabled>Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" style="font-size: 90%">Unit<sup class="text-danger">*</sup></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" placeholder="Unit (eg:KG,Pc)" required/>
                                        @error('unit')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" style="font-size: 90%">
                                        Minimum Purchase qty<sup class="text-danger">*</sup>
                                    </label>
                                    <div class="col-md-9">
                                        <input
                                            type="text"
                                            class="form-control @error('minimum_purchase_qty') is-invalid @enderror"
                                            name="minimum_purchase_qty"
                                            value="1"
                                            required
                                            oninput="validateInput(this)"
                                        />
                                        @error('minimum_purchase_qty')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" style="font-size: 90%">Tags<sup class="text-danger">*</sup></label>
                                    <div class="col-md-9">
                                        <input type="text" id="tagsInput" class="form-control @error('tags') is-invalid @enderror"/>
                                        <div id="tagsContainer" class="mt-2"></div>
                                        <input type="hidden" name="tags" id="tagsHiddenInput">
                                        @error('tags')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -4%;">
                                <h4>Product Images</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Thumbnail Image <br>
                                        <small>430 x 330</small>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control @error('thumbnail_img') is-invalid @enderror" id="imageInput" name="thumbnail_img" required/>
                                        <img id="imagePreview" class="mt-1" src="#" alt="Preview" style="display: none; max-width: 200px; max-height: 200px;">
                                        @error('thumbnail_img')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Gallery Image <br>
                                        <small>430 x 330</small>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control @error('galleryImage') is-invalid @enderror" id="imageInputGallery" name="galleryImages[]" multiple required/>
                                        <div id="imagePreviews" class="mt-1"></div>
                                        @error('galleryImage')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -4%;">
                                <h4>Product PDF</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">PDF <br>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control @error('pdf') is-invalid @enderror" accept=".pdf" name="pdf"/>
                                        @error('pdf')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -4%;">
                                <h4>Product Variation</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Product Variation</label>
                                    <div class="col-md-9">
                                        <select name="is_variant" id="is_variation" class="form-control @error('color') is-invalid @enderror">
                                            <option value="">Select option</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="variation_active" style="display: none;">
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label">Color</label>
                                        <div class="col-md-9">
                                            <select name="color_id[]" id="colors" data-selected-text-format="count" class="selectpicker form-control @error('color') is-invalid @enderror select-enabled" multiple>
                                                @foreach($colors as $color)
                                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label">Size</label>
                                        <div class="col-md-9">
                                            <select name="size_id[]" id="sizes" class="selectpicker form-control @error('size') is-invalid @enderror" data-selected-text-format="count" multiple>
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('size')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -4%;">
                                <h4>Product price + stock</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Unit price<sup class="text-danger">*</sup></label>
                                    <div class="col-md-9">
                                        <input type="number" name="sell_price" value="0" class="form-control @error('sell_price') is-invalid @enderror" placeholder="Unit price" required/>
                                        @error('sell_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Cost price<sup class="text-danger">*</sup></label>
                                    <div class="col-md-9">
                                        <input type="number" name="cost_price" value="0" class="form-control @error('cost_price') is-invalid @enderror" placeholder="Cost price" required/>
                                        @error('cost_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Discount Range Date</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control date" name="discount_date_range" id="daterange" data-toggle="date-picker" data-cancel-class="btn-warning" required>
                                        @error('discount_date_range')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Discount</label>
                                    <div class="col-md-7">
                                        <input type="number" name="discount" value="0" class="form-control @error('discount') is-invalid @enderror" placeholder="Discount"/>
                                        @error('discount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <select name="discount_type" id="" class="form-control">
                                            <option value="1">Flat</option>
                                            <option value="2">Percent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Quantity<sup class="text-danger">*</sup></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" required>
                                        @error('stock')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="variantInputsContainer" class="mb-3"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -4%;">
                                <h4>Product Description</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Enter Short Description" required></textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -4%;">
                                <h4>Product Short Description</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Active Short Description</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="is_short_description" value="1" style="margin-top: 5%;margin-left: 1%">
                                        @error('short_description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">Short Description</label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="short_description" id="shot_summernote" class="form-control @error('short_description') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Enter Short Description"></textarea>
                                        @error('short_description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -4%;">
                                <h4>Seo Meta Tag</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Meta title</label>
                                    <div class="col-md-9">
                                        <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Meta title"/>
                                        @error('meta_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Meta Description</label>
                                    <div class="col-md-9">
                                        <textarea type="text" style="height: 200px" name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Enter Meta Description"></textarea>
                                        @error('meta_description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Meta Image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="meta_image" class="form-control @error('meta_image') is-invalid @enderror" aria-describedby="emailHelp"/>
                                        @error('meta_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -9%;">
                                <h4>Featured</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-7 col-form-label">Status</label>
                                    <div class="col-md-5">
                                        <input type="checkbox" id="switch2" value="1" class="form-control" name="is_featured" data-switch="bool"/>
                                        <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="margin-bottom: -9%;">
                                <h4>Cash On Delivery</h4>
                            </div>
                            <hr/>
                            <div class="card-body" style="margin-top: -2%">
                                <div class="row mb-3">
                                    <label class="col-md-7 col-form-label">Status</label>
                                    <div class="col-md-5">
                                        <input type="checkbox" id="switch3" value="1" class="form-control" name="cash_on_delivery" data-switch="bool"/>
                                        <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar float-end mb-3" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="Second group">
                                <button type="submit" name="button"
                                        class="btn btn-success">Save & Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end col -->
    </div>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 200
        });
        $('#shot_summernote').summernote({
            tabsize: 2,
            height: 200
        });
    </script>
    <!-- end row -->
    <script>
        function validateInput(input) {
            // Remove any non-numeric characters
            input.value = input.value.replace(/[^0-9]/g, '');

            // Ensure the value is at least 1
            if (input.value < 1) {
                input.value = 1;
            }
        }
    </script>

    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }

        var imageInput = document.getElementById('imageInput');
        imageInput.addEventListener('change', previewImage);
    </script>

    <script>
        function previewImages(event) {
            var input = event.target;
            var imagePreviewsContainer = document.getElementById('imagePreviews');
            imagePreviewsContainer.innerHTML = ''; // Clear previous previews

            Array.from(input.files).forEach(file => {
                var reader = new FileReader();

                reader.onload = function() {
                    var img = document.createElement('img');
                    img.src = reader.result;
                    img.alt = 'Preview';
                    img.style.display = 'inline-block';
                    img.style.marginRight = '10px';
                    img.style.maxWidth = '80px';
                    img.style.maxHeight = '100px';
                    img.classList.add('mt-1');
                    imagePreviewsContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        }

        var imageInput = document.getElementById('imageInputGallery');
        imageInput.addEventListener('change', previewImages);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const colorsSelect = document.getElementById('colors');
            const sizesSelect = document.getElementById('sizes');
            const variantInputsContainer = document.getElementById('variantInputsContainer');
            const colorOptions = Array.from(colorsSelect.options);
            const sizeOptions = Array.from(sizesSelect.options);

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            function getColorNameById(id) {
                const color = colorOptions.find(option => option.value == id);
                return color ? color.text : '';
            }

            function getSizeNameById(id) {
                const size = sizeOptions.find(option => option.value == id);
                return size ? size.text : '';
            }

            function generateVariantInputs() {
                const selectedColors = Array.from(colorsSelect.selectedOptions).map(option => option.value);
                const selectedSizes = Array.from(sizesSelect.selectedOptions).map(option => option.value);
                variantInputsContainer.innerHTML = '';

                if (selectedColors.length > 0) {
                    selectedColors.forEach(colorId => {
                        const colorName = capitalizeFirstLetter(getColorNameById(colorId));

                        if (selectedSizes.length > 0) {
                            selectedSizes.forEach(sizeId => {
                                const sizeName = getSizeNameById(sizeId);
                                const variantHtml = `
                            <div class="row mb-3 variant-row" data-color="${colorId}" data-size="${sizeId}">
                                <label class="col-md-3 col-form-label">${colorName} - ${sizeName}</label>
                                <input type="hidden" name="variant_name_${colorId}_${sizeId}" class="form-control" value="${colorName} - ${sizeName}" readonly />
                                <div class="col-md-3">
                                    <input type="number" name="variant_price_${colorId}_${sizeId}" class="form-control" placeholder="Price" required />
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="variant_qty_${colorId}_${sizeId}" class="form-control" placeholder="Quantity" required />
                                </div>
                                <div class="col-md-3">
                                    <input type="file" name="variant_image_${colorId}_${sizeId}" class="form-control" />
                                </div>
                            </div>
                        `;
                                variantInputsContainer.insertAdjacentHTML('beforeend', variantHtml);
                            });
                        } else {
                            const variantHtml = `
                        <div class="row mb-3 variant-row" data-color="${colorId}">
                            <label class="col-md-3 col-form-label">${colorName}</label>
                            <input type="hidden" name="variant_name_${colorId}" class="form-control" value="${colorName}" readonly />
                            <div class="col-md-3">
                                <input type="number" name="variant_price_${colorId}" class="form-control" placeholder="Price" required />
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="variant_qty_${colorId}" class="form-control" placeholder="Quantity" required />
                            </div>
                            <div class="col-md-3">
                                <input type="file" name="variant_image_${colorId}" class="form-control" />
                            </div>
                        </div>
                    `;
                            variantInputsContainer.insertAdjacentHTML('beforeend', variantHtml);
                        }
                    });
                } else if (selectedSizes.length > 0) { // Handle the case where only sizes are selected
                    selectedSizes.forEach(sizeId => {
                        const sizeName = capitalizeFirstLetter(getSizeNameById(sizeId));
                        const variantHtml = `
                    <div class="row mb-3 variant-row" data-size="${sizeId}">
                        <label class="col-md-3 col-form-label">${sizeName}</label>
                        <input type="hidden" name="variant_name_${sizeId}" class="form-control" value="${sizeName}" readonly />
                        <div class="col-md-3">
                            <input type="number" name="variant_price_${sizeId}" class="form-control" placeholder="Price" required />
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="variant_qty_${sizeId}" class="form-control" placeholder="Quantity" required />
                        </div>
                        <div class="col-md-3">
                            <input type="file" name="variant_image_${sizeId}" class="form-control" />
                        </div>
                    </div>
                `;
                        variantInputsContainer.insertAdjacentHTML('beforeend', variantHtml);
                    });
                }
            }

            colorsSelect.addEventListener('change', generateVariantInputs);
            sizesSelect.addEventListener('change', generateVariantInputs);

            // Initial load
            generateVariantInputs();
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var isVariationSelect = document.getElementById('is_variation');
            var variationActiveDiv = document.getElementById('variation_active');

            function toggleVariationDiv() {
                if (isVariationSelect.value === 'yes') {
                    variationActiveDiv.style.display = 'block';
                } else {
                    variationActiveDiv.style.display = 'none';
                }
            }
            // Initial check
            toggleVariationDiv();

            // Add event listener
            isVariationSelect.addEventListener('change', toggleVariationDiv);
        });
    </script>

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

    <script>
        $(document).ready(function() {
            // Get today's date
            const today = moment();

            $('#daterange').daterangepicker({
                startDate: today, // Set today's date as the default start date
                endDate: today, // Set today's date as the default end date
                autoUpdateInput: true, // Automatically show the selected date in the input
                locale: {
                    cancelLabel: 'Clear',
                    applyLabel: 'Apply',
                    format: 'MM/DD/YYYY'
                }
            });

            // Handle the apply event
            $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            // Handle the cancel event
            $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
