@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="main-content mt-4">
            <div class="row ">
                <div class="col-xs-12 col-sm-3">
                    <div class="item-left">
                        <h3>danh mục</h3>
                        <ul class="ul accordion">
                            @foreach ($list_category as $list_item)
                                <li class="list_menu">
                                    <a href="/menu/{{ $list_item->name }}" class="link" style=""
                                        title="">{{ $list_item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="item-left">
                        <form method="get" action="" onsubmit="frmFilterPost(this); return false;">
                            <h3>lọc theo</h3>
                            <div class="form-left">
                                <p class="text-center">
                                    <button type="submit" class="btn bg delay">Tìm kiếm</button>
                                </p>
                            </div>
                        </form>
                    </div>
                    <div class="news-left-item item-left over related_products">
                        <h3>Sản phẩm khác</h3>
                        <ul class="ul">
                            @foreach ($related_products as $related_products_item)
                                <li class="w over d-flex pb-4">
                                    <div class="img over pull-left w-25 pe-2">
                                        <a href="/product/{{ $related_products_item->id }}">
                                            <img src="{{ $related_products_item->image }}">
                                        </a>
                                    </div>
                                    <div class="text-item pull-left">
                                        <a href="/product/{{ $related_products_item->id }}" class="text-dark">{{ $related_products_item->title }}</a></br>
                                        <label class=" fw-bold d-flex">giá:&nbsp<p class="text-success">
                                                {{ number_format($related_products_item->discount, 0, ',', '.') }} đ</p>
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9 pull-right">
                    <div class="show-main">
                        @foreach ($category as $category)
                            <h3>{{ $category->name }}</h3>
                            {{-- <h2 style="display: none">Phòng khách</h2> --}}
                            <div class="show-product">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="item item-banner">
                                            <div class="img over">
                                                <a href="#" title="Phòng khách">
                                                    <img src="{{ $category->image }} " alt="" title=""
                                                        class="w-100">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products">
                                        <div class="row row-0">
                                            @foreach ($products as $products_item)
                                                <div class="col-xs-12 col-sm-6 col-md-4 mt-4">
                                                    <a href="/product/{{ $products_item->id }}" class="product-img">
                                                        <img src="{{ $products_item->image }}" alt=""
                                                            title="">
                                                    </a>
                                                    <div class="spen-product over">
                                                        <div class="over">
                                                            <div class="product-card">
                                                                <h4>
                                                                    <label class="">
                                                                        <a href="/product/{{ $products_item->id }}">{{ $products_item->title }}</a>
                                                                    </label>
                                                                </h4>
                                                                <div class="right pull-right text-right">
                                                                @if ($products_item->price !=0)
                                                                     <label
                                                                        class="through fw-bold text-decoration-line-through text-dark ">{{ number_format($products_item->price, 0, ',', '.') }}
                                                                        đ
                                                                    </label></br>
                                                                @endif
                                                                   

                                                                    <label
                                                                        class="red fw-bold text-success">{{ number_format($products_item->discount, 0, ',', '.') }}
                                                                        đ
                                                                    </label>
                                                                </div>
                                                                <a href="/" class="delay bg" title="">Xem chi
                                                                    tiết</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <h3>có thể bạn quan tâm</h3>
                <div class="col-xs-12 col-0" style="padding: 0 10px">
                    <div class="wrapper">
                        <i id="left" class="fa-solid fa-angle-left z-2"></i>
                        <ul class="carousel">
                            @foreach ($handbook as $handbook_item)
                                <li class="card ">
                                    <div class="img"><img src="{{ $handbook_item->image }}" alt="img" draggable="false"></div>
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
@endsection
