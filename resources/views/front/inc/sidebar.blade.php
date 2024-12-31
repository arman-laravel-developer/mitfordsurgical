<div class="sidebar-col">
    <div class="category-menu">
        <!-- Logo -->
        <a href="{{route('home')}}" class="web-logo nav-logo">
            <img src="{{asset('/')}}front/assets/images/logo/5.png" style="width: 100%" class="img-fluid blur-up lazyload" alt="Medical Shop Logo">
        </a>

        <!-- Category List -->
        <ul class="list-unstyled" style="gap: 13px;">
            @foreach($menuCategories as $menuCategory)
                <li>
                    <div class="category-list d-flex justify-content-between align-items-center">
                        <h5>
                            <a href="{{ route('category.product', ['id' => $menuCategory->id, 'slug' => $menuCategory->slug]) }}"
                               class="category-toggle {{ request()->is('category-products/'.$menuCategory->id.'-'.$menuCategory->slug) ? 'active' : '' }}"
                               data-bs-target="#category{{$menuCategory->id}}"
                               aria-expanded="{{ request()->is('category-products/'.$menuCategory->id.'-'.$menuCategory->slug) ? 'true' : 'false' }}"
                               aria-controls="category{{$menuCategory->id}}">
                                {{$menuCategory->getTranslation('category_name')}}
                            </a>
                        </h5>
                        @if(count($menuCategory->subCategories) > 0)
                            <i style="cursor: pointer;" class="fa-solid {{ request()->is('category-products/'.$menuCategory->id.'-'.$menuCategory->slug) || collect($menuCategory->subCategories)->pluck('id')->contains(request()->route('id')) ? 'fa-angle-down' : 'fa-angle-right' }} arrow-icon"></i>
                        @endif
                    </div>
                    @if(count($menuCategory->subCategories) > 0)
                        <div id="category{{$menuCategory->id}}"
                             class="collapse {{ request()->is('category-products/'.$menuCategory->id.'-'.$menuCategory->slug) || collect($menuCategory->subCategories)->pluck('id')->contains(request()->route('id')) ? 'show' : '' }}">
                            <ul class="list-unstyled ps-3" style="gap: 4px; margin-top: 2%;">
                                @foreach($menuCategory->subCategories as $subCategory)
                                    <li>
                                        <a href="{{ route('category.product', ['id' => $subCategory->id, 'slug' => $subCategory->slug]) }}"
                                           class="{{ request()->is('category-products/'.$subCategory->id.'-'.$subCategory->slug) ? 'active' : '' }}">
                                            {{$subCategory->getTranslation('category_name')}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.arrow-icon').forEach(icon => {
            icon.addEventListener('click', function () {
                // Find the nearest sibling `.collapse` element within the same `li`
                const parentLi = this.closest('li');
                const submenu = parentLi.querySelector('.collapse');

                if (submenu) {
                    // Toggle the 'show' class on the submenu
                    submenu.classList.toggle('show');

                    // Change the arrow icon based on the submenu's visibility
                    const isExpanded = submenu.classList.contains('show');
                    this.classList.toggle('fa-angle-down', isExpanded);
                    this.classList.toggle('fa-angle-right', !isExpanded);
                }
            });
        });
    });
</script>
