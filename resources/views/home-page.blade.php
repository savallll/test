@extends('layouts.main')
@section('content')
    {{-- <ul class="d-flex " type="none" >
        @foreach ($menu as $item)
                    <li><a href="">{{$item->name}}</a></li>
        @endforeach
    </ul> --}}
    {{-- <div class="d-flex">
        @foreach ($menu as $menus)
            <div class="dropdown ms-4 mt-4">
                <a class="" type="" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false"    
                    href="menu/{{ $menus->name }}">
                    {{ $menus->name }}
                </a>
                @foreach ($menu_items as $menuitems)
                    @if ($menuitems->menu_id == $menus->id)
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($menu_items as $menuitems)
                                @if ($menuitems->menu_id == $menus->id)
                                    <li><a class="dropdown-item"
                                            href="menu/{{ $menuitems->name }}">{{ $menuitems->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                @endforeach

            </div>
        @endforeach
    </div> --}}



    @foreach ($banner as $banner_item)
        <div class="container-fluid px-0">
            @if ($banner_item->id == 1)
                <img src="{{ $banner_item->image }}" alt="" class="main-banner">
            @endif
        </div>
    @endforeach

    <div class="container ">
        <div class="row">
            @foreach ($banner as $banner_item)
                @if ($banner_item->id !== 1)
                    <div class="col-md-6 col-sm-12 mt-4">
                        <img src="{{ $banner_item->image }}" alt="">

                    </div>
                @endif
            @endforeach

        </div>
    </div>



    {{-- content --}}
    <h1 class="py-5 text-center">content ở đây</h1>



    <div class="container mt-4">
        <h3>có thể bạn quan tâm</h3>
        <div class="col-xs-12 col-0" style="padding: 0 10px">
            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left z-2"></i>
                <ul class="carousel">
                    @foreach ($handbook as $handbook_item)
                        <li class="card ">
                            <div class="img"><img src="{{ $handbook_item->image }}" alt="img" draggable="false">
                            </div>
                            <h2>{{ $handbook_item->title }}</h2>
                            <span>{{ $handbook_item->created_at }}</span>
                        </li>
                    @endforeach
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>

            <script>
                const wrapper = document.querySelector(".wrapper");
                const carousel = document.querySelector(".carousel");
                const firstCardWidth = carousel.querySelector(".card").offsetWidth;
                const arrowBtns = document.querySelectorAll(".wrapper i");
                const carouselChildrens = [...carousel.children];

                let isDragging = false,
                    isAutoPlay = true,
                    startX, startScrollLeft, timeoutId;

                // Get the number of cards that can fit in the carousel at once
                let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

                // Insert copies of the last few cards to beginning of carousel for infinite scrolling
                carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
                    carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
                });

                // Insert copies of the first few cards to end of carousel for infinite scrolling
                carouselChildrens.slice(0, cardPerView).forEach(card => {
                    carousel.insertAdjacentHTML("beforeend", card.outerHTML);
                });

                // Scroll the carousel at appropriate postition to hide first few duplicate cards on Firefox
                carousel.classList.add("no-transition");
                carousel.scrollLeft = carousel.offsetWidth;
                carousel.classList.remove("no-transition");

                // Add event listeners for the arrow buttons to scroll the carousel left and right
                arrowBtns.forEach(btn => {
                    btn.addEventListener("click", () => {
                        carousel.scrollLeft += btn.id == "left" ? -firstCardWidth : firstCardWidth;
                    });
                });

                const dragStart = (e) => {
                    isDragging = true;
                    carousel.classList.add("dragging");
                    // Records the initial cursor and scroll position of the carousel
                    startX = e.pageX;
                    startScrollLeft = carousel.scrollLeft;
                }

                const dragging = (e) => {
                    if (!isDragging) return; // if isDragging is false return from here
                    // Updates the scroll position of the carousel based on the cursor movement
                    carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
                }

                const dragStop = () => {
                    isDragging = false;
                    carousel.classList.remove("dragging");
                }

                const infiniteScroll = () => {
                    // If the carousel is at the beginning, scroll to the end
                    if (carousel.scrollLeft === 0) {
                        carousel.classList.add("no-transition");
                        carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
                        carousel.classList.remove("no-transition");
                    }
                    // If the carousel is at the end, scroll to the beginning
                    else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
                        carousel.classList.add("no-transition");
                        carousel.scrollLeft = carousel.offsetWidth;
                        carousel.classList.remove("no-transition");
                    }

                    // Clear existing timeout & start autoplay if mouse is not hovering over carousel
                    clearTimeout(timeoutId);
                    if (!wrapper.matches(":hover")) autoPlay();
                }

                const autoPlay = () => {
                    if (window.innerWidth < 800 || !isAutoPlay)
                        return; // Return if window is smaller than 800 or isAutoPlay is false
                    // Autoplay the carousel after every 2500 ms
                    timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
                }
                autoPlay();

                carousel.addEventListener("mousedown", dragStart);
                carousel.addEventListener("mousemove", dragging);
                document.addEventListener("mouseup", dragStop);
                carousel.addEventListener("scroll", infiniteScroll);
                wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
                wrapper.addEventListener("mouseleave", autoPlay);
            </script>



            {{--  --}}


            {{--  --}}
        </div>
    </div>
@endsection('')
