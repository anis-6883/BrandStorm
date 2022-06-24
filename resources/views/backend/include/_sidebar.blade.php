<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            {{-- <li class="nav-label">Dashboard</li> --}}
            <li>
                <a href="javascript:void()" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-menu menu-icon"></i><span class="nav-text">Category</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('category.index') }}" aria-expanded="false">List Category</a></li>
                    <li><a href="{{ route('category.create') }}" aria-expanded="false">Add Category</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf0cb;</i><span class="nav-text">Subcategory</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('subcategory.index') }}" aria-expanded="false">List Subcategory</a></li>
                    <li><a href="{{ route('subcategory.create') }}" aria-expanded="false">Add Subcategory</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf1c6;</i><span class="nav-text">Package</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('package.index') }}" aria-expanded="false">List Package</a></li>
                    <li><a href="{{ route('package.create') }}" aria-expanded="false">Add Package</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>