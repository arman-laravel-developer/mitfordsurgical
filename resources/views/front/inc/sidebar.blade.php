<div class="sidebar-col">
    <div class="category-menu">
        <!-- Logo -->
        <a href="{{route('home')}}" class="web-logo nav-logo">
            <img src="{{asset('/')}}front/assets/images/logo/5.png" style="width: 100%" class="img-fluid blur-up lazyload" alt="Medical Shop Logo">
        </a>

        <!-- Category List -->
        <ul class="list-unstyled" style="gap: 13px;">

            <!-- Loop: Category 1 to 12 -->
            <!-- Category 1 -->
            @foreach($menuCategories as $menuCategory)
            <li>
                <div class="category-list d-flex justify-content-between align-items-center">
                    <h5>
                        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#category{{$menuCategory->id}}" aria-expanded="false" aria-controls="category{{$menuCategory->id}}">
                            {{$menuCategory->category_name}}
                        </a>
                    </h5>
                    @if(count($menuCategory->subCategories) > 0)
                    <i class="fa-solid fa-angle-right arrow-icon"></i>
                    @endif
                </div>
                @if(count($menuCategory->subCategories) > 0)
                <div id="category{{$menuCategory->id}}" class="collapse">
                    <ul class="list-unstyled ps-3" style="gap: 4px; margin-top: 2%;">
                        @foreach($menuCategory->subCategories as $subCategory)
                        <li><a href="#">{{$subCategory->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </li>
            @endforeach

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
