<div class="container-fluid border-bottom d-flex align-items-center justify-content-between header">
    <div class="h-100 ">
        <a href="/"><img src="https://i.pinimg.com/550x/dd/59/6d/dd596d0afdb5459b69ea090e14969ecd.jpg" alt=""
                class=" h-100"></a>
    </div>
    <div class="d-flex h-100 align-items-center">
        <form class="w-100 me-3">
            <input type="search" class="form-control search-input" placeholder="Search..." aria-label="Search">
        </form>
        <div class="px-5 h-25 d-flex">
            <img src="https://logistics-sun.com/wp-content/uploads/2023/04/phone-call.png" alt=""
                class="pe-2">
            <p class="my-0">0906264268</p>
        </div>
    </div>
    <div class="d-flex h-100 align-items-center">

        @if (Session::has('user'))
            <a href="/showCart" class="h-25 pe-2"><img src="https://cdn-icons-png.flaticon.com/128/649/649931.png"
                    alt=""></a>
            <div class="dropdown-center d-flex h-25 ps-4">
                <a class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    class="">
                    <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="">
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Action two</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/user/logout">logout</a></li>
                </ul>
            </div>
        @else
            <a href="/login" class="btn btn-secondary" style="width: 100px">login</a>
        @endif
    </div>
</div>
{{-- </div> --}}


<nav class="navbar navbar-expand-lg  bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="/">Navbar</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @foreach ($menu as $menu_item)
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if ($menu_item->id < 5)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/menu/{{ $menu_item->name }}"
                                aria-expanded="false">
                                {{ $menu_item->name }}
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                @foreach ($categories as $category_items)
                                    @if ($category_items->menu_id == $menu_item->id)
                                        @if ($category_items->menu_id == $menu_item->id)
                                            <li><a class="dropdown-item"
                                                    href="/menu/{{ $category_items->name }}">{{ $category_items->name }}</a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>

                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/menu/{{ $menu_item->name }}">{{ $menu_item->name }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        @endforeach

    </div>
</nav>
