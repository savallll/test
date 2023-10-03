@extends('layouts.main')
@section('content')
    <div class="container mt-5">
        @foreach ($product as $product_item)
            <div class="row">
                <div class="col-xs-12 col-sm-6 dt1 border-end">
                    <div class="w3-content">
                        <div style="product_img">
                            <img class="mySlides" src="{{ $product_item->image }}" style="width:100%">
                            @foreach ($thumbnail_product as $thumbnail_product_item)
                                <img class="mySlides" src="{{ $thumbnail_product_item->image }}"
                                    style="width:100%;display:none">
                                {{-- <img class="mySlides" src="" style="width:100%; display:none"> --}}
                            @endforeach
                        </div>

                        <div class="w3-row-padding w3-section d-flex pt-4 justify-content-center">
                            <div class="w3-col s4 border mx-2 w-25">
                                <img class="demo w3-opacity w3-hover-opacity-off" src="{{ $product_item->image }}"
                                    style="width:100%;cursor:pointer" onclick="currentDiv(1)">
                            </div>

                            @foreach ($thumbnail_product as $thumbnail_product_item)
                                <div class="w3-col s4 border mx-2 w-25 ">
                                    <img class="demo w3-opacity w3-hover-opacity-off"
                                        src="{{ $thumbnail_product_item->image }}" style="width:100%;cursor:pointer"
                                        onclick="currentDiv({{ $loop->iteration + 1 }})">
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <script>
                        function currentDiv(n) {
                            showDivs(slideIndex = n);
                        }

                        function showDivs(n) {
                            var i;
                            var x = document.getElementsByClassName("mySlides");
                            var dots = document.getElementsByClassName("demo");
                            if (n > x.length) {
                                slideIndex = 1
                            }
                            if (n < 1) {
                                slideIndex = x.length
                            }
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = "none";
                            }
                            for (i = 0; i < dots.length; i++) {
                                dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
                            }
                            x[slideIndex - 1].style.display = "block";
                            dots[slideIndex - 1].className += " w3-opacity-off";
                        }
                    </script>
                </div>

                <div class="col-xs-12 col-sm-6 dt2 ps-4">
                    <div class="list-detail over">
                        <h1>{{ $product_item->title }}</h1>
                        <h2 style="display:none;position: absolute">{{ $product_item->title }}</h2>
                        {{-- <label class="through">{{ $product_item->price }}</label> --}}
                        <label
                            class="red fw-bold text-dark text-decoration-line-through">{{ number_format($product_item->price, 0, ',', '.') }}
                            đ
                        </label></br>
                        <label
                            class="red fw-bold text-success pt-2 fs-5">{{ number_format($product_item->discount, 0, ',', '.') }}
                            đ
                        </label>
                        <div class="prameter pb-4">
                            <ul>
                                <li>
                                    <span><b>Kích thước(cm): </b></span>
                                    {{ $product_item->size }}
                                </li>
                                <li>
                                    <span><b>chất liệu: </b></span>
                                    {{ $product_item->Material }}
                                </li>
                            </ul>
                        </div>
                        {{-- <a href="javascript:;" class="bg delay" title="">Mua online</a>
                        <a href="javascript:;" class="bg delay bl" title="">Liên hệ nhận tư vấn</a> --}}
                        @foreach ($product as $product_item)
                        {{-- <a href="
                                @if (Session::has('user'))
                                    /cart/{{ $product_item->id }}
                                @else
                                    /login
                                @endif 
                            " 
                            class="btn btn-warning add-cart"></a> --}}
                        <div class="d-flex">
                            <form action="
                                @if (Session::has('user'))
                                    /addCart/{{ $product_item->id }}
                                @else
                                    /login
                                @endif " method="post">
                                @csrf
                                <input type="hidden"  name="img" value="{{ $product_item->image }}">
                                <input type="hidden"  name="name" value="{{ $product_item->title }}">
                                <input type="hidden"  name="price" value="{{ $product_item->price }}">
                                <input type="hidden"  name="size" value="{{ $product_item->size }}">
                                <input type="hidden"  name="quantity" value="1">
                                <button type="submit" class="btn btn-warning add-cart">Thêm vào giỏ hàng</button>

                            </form>
                            <a href="" class="btn btn-success ms-2">Mua hàng</a>
                            
                        </div>
                        @if ($errors->has('mess'))
                            <p class="text-danger pt-2">{{ $errors->first('mess') }}</p>
                        @else
                            <p class="text-success pt-2">{{ Session::get('success') }}</p>
                        @endif
                        @endforeach
                        {{-- <script>
                            var button_addcart = document.getelementbyid(add-cart)
                            var form_add_cart = document.forms['form_add_cart']

                            button_addcart.addEventListener('click', function() {
                                form_add_cart.action= {{ secsi }}
                                form_add_cart.submit()
                            });
                        </script> --}}
                    </div>
                    {{-- <div class="popup-prameter popup-1">
                    <div class="registration">
                        <span class="close">x</span>
                        <div class="tit">
                            <h2>Đăng ký mua online</h2>
                        </div>
                        <div class="form-dk">
                            <form id="BookOnline" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <input type="hidden" name="ContentID" value="8794">
                                            <input type="text" class="form-control" name="fullname"
                                                placeholder="Họ và Tên (bắt buộc)">
                                            <label class="radio-inline"><input type="radio" name="Mr" value="Anh"
                                                    checked="">Anh</label>
                                            <label class="radio-inline"><input type="radio" name="Mr"
                                                    value="Chị">Chị</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="Số điện thoại (bắt buộc)">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Email (bắt buộc)">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" name="comment" placeholder="Ghi chú khác của quý khách"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <button id="btn-book">Đăng ký ngay <i class="fa fa-paper-plane"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div style="display:none;" id="alrtBook">
                                <p style="background: #21409a;padding:5px 0px;color:#ffffff;padding:10px;margin-top:15px;">
                                    Thông tin của bạn đã được gửi, chúng tôi sẽ liên hệ lại với bạn trong 1-2 ngày tới.</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                    {{-- <div class="popup-prameter popup-2">
                    <div class="registration">
                        <span class="close">x</span>
                        <div class="tit">
                            <h2>Đăng ký nhận tư vấn</h2>
                        </div>
                        <div class="form-dk">
                            <form id="Registration" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <input type="hidden" name="ContentID" value="8794">
                                            <input type="text" class="form-control" name="fullname"
                                                placeholder="Họ và Tên (bắt buộc)">
                                            <label class="radio-inline"><input type="radio" name="Mr"
                                                    value="Anh" checked="">Anh</label>
                                            <label class="radio-inline"><input type="radio" name="Mr"
                                                    value="Chị">Chị</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="Số điện thoại (bắt buộc)">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Email (bắt buộc)">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" name="comment" placeholder="Ghi chú khác của quý khách"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <button id="btn-register">Đăng ký ngay <i class="fa fa-paper-plane"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div style="display:none;" id="alrt">
                                <p style="background: #21409a;padding:5px 0px;color:#ffffff;padding:10px;margin-top:15px;">
                                    Thông tin của bạn đã được gửi, chúng tôi sẽ liên hệ lại với bạn trong 1-2 ngày tới.</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                    {{-- <script>
                    $(document).ready(function() {
                        $("#BookOnline").validate({
                            rules: {
                                fullname: {
                                    required: true
                                },
                                comment: {
                                    required: true
                                },
                                phone: {
                                    required: true,
                                    number: true
                                },
                                email: {
                                    required: true,
                                    email: true,
                                },
                            },
                            messages: {
                                fullname: {
                                    required: "*",
                                },
                                comment: {
                                    required: "*",
                                },
                                phone: {
                                    required: "*",
                                    number: "*",
                                },
                                email: {
                                    required: "*",
                                    email: "*",
                                },
                            },
                            submitHandler: function() {
                                var d = $("#BookOnline").serialize();
                                $("#btn-book").unbind("click").text("Đang gửi...");
                                var url = "/Ajax/Home/BookOnline";
                                $.post(url, d, function(msg) {
                                    if (msg.Erros == false) {
                                        $('#alrtBook').slideDown();
                                        setInterval(function() {
                                            window.location.reload();
                                        }, 5000);
                                    } else {
                                        swal(msg.Title, msg.msg, "error");
                                        $("#btn-book").text("Gửi đi");
                                    }
                                }, "json");
                            }
                        });
                        $("#Registration").validate({
                            rules: {
                                fullname: {
                                    required: true
                                },
                                comment: {
                                    required: true
                                },
                                phone: {
                                    required: true,
                                    number: true
                                },
                                email: {
                                    required: true,
                                    email: true,
                                },
                            },
                            messages: {
                                fullname: {
                                    required: "*",
                                },
                                comment: {
                                    required: "*",
                                },
                                phone: {
                                    required: "*",
                                    number: "*",
                                },
                                email: {
                                    required: "*",
                                    email: "*",
                                },
                            },
                            submitHandler: function() {
                                var d = $("#Registration").serialize();
                                $("#btn-register").unbind("click").text("Đang gửi...");
                                var url = "/Ajax/Home/Registration";
                                $.post(url, d, function(msg) {
                                    if (msg.Erros == false) {
                                        //swal(msg.Title, msg.msg, "success"); $("#btn-contact").text("Gửi đi");
                                        $('#alrt').slideDown();
                                        setInterval(function() {
                                            window.location.href = "/dang-ky-thanh-cong";
                                        }, 2500);
                                    } else {
                                        swal(msg.Title, msg.msg, "error");
                                        $("#btn-register").text("Gửi đi");
                                    }
                                }, "json");
                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $(".list-detail a.bg.delay").click(function() {
                            $(".popup-prameter.popup-1").addClass('show');
                        });
                        $(".list-detail a.bg.delay.bl").click(function() {
                            $(".popup-prameter.popup-2").addClass('show');
                            $(".popup-prameter.popup-1").removeClass('show');
                        });
                    });
                    $(document).ready(function() {
                        $(".popup-prameter .close").click(function() {
                            $(".popup-prameter").removeClass('show');
                        });
                    });
                </script> --}}


                </div>
                <div class="cre-detail oppen-list over show-open mt-5">
                    <h3 class="">Mô tả sản phẩm</h3>
                    <div class="desc-sp" id="Desc-sp">
                        <div class="content">
                            <pre style="text-align: justify;white-space: pre-wrap;" class="fw-normal fs-6 text">{{ $product_item->description }}</pre>

                        </div>
                        @if ($product_item->description != null)
                            <div class="container text-center">
                                <button class="toggle-button bg-white border-0 fst-italic text-secondary">Xem thêm...</button>
                            </div>
                        @endif
                        <script>
                            var button = document.querySelector('.toggle-button');
                            var content = document.querySelector('.content');

                            button.addEventListener('click', function() {
                                content.classList.toggle('expanded');
                                if (button.textContent === 'Xem thêm...') {
                                    button.textContent = '...Thu gọn';
                                } else {
                                    button.textContent = 'Xem thêm...';
                                }
                            });
                        </script>
                        {{-- <div class="active-open" style="display: none;">
                            <div class="on-list text-center">
                                <a href="javascript:;" class="delay bg on-detail" title="xem thêm">xem thêm</a>
                            </div>
                            <div class="on-list text-center hidden on-hidden">
                                <a href="javascript:;" class="delay bg on-hiden" title="Thu gọn">Thu gọn</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
        @endforeach

        <div class="row mt-5">
            <h3 class="">sản phẩm khác</h3>
            <div class="col-xs-12 col-0" style="padding: 0 10px">
                <div class="wrapper">
                    <i id="left" class="fa-solid fa-angle-left z-2"></i>
                    <ul class="carousel">
                        @foreach ($related_products as $related_products_item)
                            <li class="card ">
                                <div class="img">
                                    {{-- <a href="{{ $related_products_item->id }}"> --}}
                                        <img src="{{ $related_products_item->image }}" alt="img" draggable="false">
                                    {{-- </a> --}}
                                </div>
                                <h2>{{ $related_products_item->title }}</h2>
                                <span
                                    class="text-success">{{ number_format($related_products_item->discount, 0, ',', '.') }}
                                    đ</span>
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

    </div>
@endsection
