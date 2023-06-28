<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                @foreach ($categories_sidebar as $category)
                    <li>
                        <a href="{{ route('product.category', $category->slug) }}" title="">{{ $category->name }}</a>

                        @if ($category->CategoryChilren->count())
                            <i class="fa fa-angle-right arrow" aria-hidden="true"></i>

                            <ul class="sub-menu">
                                @foreach ($category->CategoryChilren as $categoryChilren)
                                    <li>
                                        <a href="{{ route('product.category', $categoryChilren->slug) }}"
                                            title="">{{ $categoryChilren->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title">Bộ lọc</h3>
        </div>
        <div class="section-detail">
            <form method="POST" action="">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="r-price" class="price" value="?price=500"></td>
                            <td>Dưới 500.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="price" value="?price=500_1000"></td>
                            <td>500.000đ - 1.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="price" value="?price=1000_5000"></td>
                            <td>1.000.000đ - 5.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="price" value="?price=5000_10000"></td>
                            <td>5.000.000đ - 10.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="price" value="?price=10000"></td>
                            <td>Trên 10.000.000đ</td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Dòng</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category_sidebar as $item)
                            @if ($item->parent_id > 0)
                                <tr>
                                    <td><input type="radio" class="brand" name="brand" data-filter="brand"
                                            value="{{ $item->id }}"></td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                            @endif
                        @endforeach


                    </tbody>
                </table>
                {{-- <table>
                    <thead>
                        <tr>
                            <td colspan="2">Loại</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="r-price"></td>
                            <td>Điện thoại</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price"></td>
                            <td>Laptop</td>
                        </tr>
                    </tbody>
                </table> --}}
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("input[type='radio'].price").change(function() {
            var price = $("input[type='radio'].price:checked").val();
            if (price) {
                window.location = price;
            }
            return false;
        });

        $(".brand").click(function() {
            var brand = []; var temp_arr  = [];
            $.each( $("[data-filter=brand]:checked"), function(){
                temp_arr.push($(this).val());
            });
            // alert(temp_arr);
            temp_arr.reverse();
            if(temp_arr.length !== 0 ){
                brand = "?brand=" + temp_arr.toString();
            }
            window.location.href = brand;
        });


    });
</script>
