<div class="sidebar-col">
    <div class="category-menu">
        <!-- Logo -->
        <a href="index.html" class="web-logo nav-logo">
            <img src="{{asset('/')}}front/assets/images/logo/5.png" style="width: 100%" class="img-fluid blur-up lazyload" alt="Medical Shop Logo">
        </a>

        <!-- Category List -->
        <ul class="list-unstyled" style="gap: 13px;">

            <!-- Loop: Category 1 to 12 -->
            <!-- Category 1 -->
            <li>
                <div class="category-list d-flex justify-content-between align-items-center">
                    <h5>
                        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#category1" aria-expanded="false" aria-controls="category1">
                            Medicines
                        </a>
                    </h5>
                    <i class="fa-solid fa-angle-right arrow-icon"></i>
                </div>
                <div id="category1" class="collapse">
                    <ul class="list-unstyled ps-3" style="gap: 4px; margin-top: 2%;">
                        <li><a href="#">Pain Relievers</a></li>
                        <li><a href="#">Cold & Flu</a></li>
                        <li><a href="#">Antibiotics</a></li>
                    </ul>
                </div>
            </li>

            <!-- Category 2 -->
            <li>
                <div class="category-list d-flex justify-content-between align-items-center">
                    <h5>
                        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#category2" aria-expanded="false" aria-controls="category2">
                            Vitamins & Supplements
                        </a>
                    </h5>
                    <i class="fa-solid fa-angle-right arrow-icon"></i>
                </div>
                <div id="category2" class="collapse">
                    <ul class="list-unstyled ps-3" style="gap: 4px; margin-top: 2%;">
                        <li><a href="#">Multivitamins</a></li>
                        <li><a href="#">Mineral Supplements</a></li>
                        <li><a href="#">Herbal Supplements</a></li>
                    </ul>
                </div>
            </li>

            <!-- Category 3 -->
            <li>
                <div class="category-list d-flex justify-content-between align-items-center">
                    <h5>
                        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#category3" aria-expanded="false" aria-controls="category3">
                            Personal Care
                        </a>
                    </h5>
                    <i class="fa-solid fa-angle-right arrow-icon"></i>
                </div>
                <div id="category3" class="collapse">
                    <ul class="list-unstyled ps-3" style="gap: 4px; margin-top: 2%;">
                        <li><a href="#">Skin Care</a></li>
                        <li><a href="#">Hair Care</a></li>
                        <li><a href="#">Oral Care</a></li>
                    </ul>
                </div>
            </li>

            <!-- Category 4 -->
            <li>
                <div class="category-list d-flex justify-content-between align-items-center">
                    <h5>
                        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#category4" aria-expanded="false" aria-controls="category4">
                            First Aid
                        </a>
                    </h5>
                    <i class="fa-solid fa-angle-right arrow-icon"></i>
                </div>
                <div id="category4" class="collapse">
                    <ul class="list-unstyled ps-3" style="gap: 4px; margin-top: 2%;">
                        <li><a href="#">Bandages</a></li>
                        <li><a href="#">Antiseptics</a></li>
                        <li><a href="#">First Aid Kits</a></li>
                    </ul>
                </div>
            </li>

            <!-- Category 5 -->
            <li>
                <div class="category-list d-flex justify-content-between align-items-center">
                    <h5>
                        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#category5" aria-expanded="false" aria-controls="category5">
                            Baby Care
                        </a>
                    </h5>
                    <i class="fa-solid fa-angle-right arrow-icon"></i>
                </div>
                <div id="category5" class="collapse">
                    <ul class="list-unstyled ps-3" style="gap: 4px; margin-top: 2%;">
                        <li><a href="#">Diapers</a></li>
                        <li><a href="#">Baby Food</a></li>
                        <li><a href="#">Baby Skin Care</a></li>
                    </ul>
                </div>
            </li>

            <!-- Categories 6 to 12 -->
            <!-- Repeating the same structure for each -->
        </ul>
    </div>

    <!-- JavaScript for dynamic arrow icon -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggles = document.querySelectorAll('.category-toggle');

            toggles.forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    const icon = this.closest('.category-list').querySelector('.arrow-icon');

                    // Delay to ensure Bootstrap collapse toggles
                    setTimeout(() => {
                        if (this.getAttribute('aria-expanded') === 'true') {
                            icon.classList.remove('fa-angle-right');
                            icon.classList.add('fa-angle-down');
                        } else {
                            icon.classList.remove('fa-angle-down');
                            icon.classList.add('fa-angle-right');
                        }
                    }, 200);
                });
            });
        });
    </script>
</div>
