$(document).ready(function(){
    $('.add-cart-ajax').click(function(event){
        event.preventDefault();
        var id = $(this).data('id');
        var url_cart_show = $(this).data('url');
        var url_add = $(this).attr('href');
        var num_order = $('#num-order').val();
        if(num_order){
            var qty = num_order;
            // alert(qty);
        } else {
            qty = 1;
            // alert(qty);
        }
        $.ajax({
            url: url_add,
            method: 'GET',
            dataType: 'html',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                qty: qty,
            },
            success: function(data) {
                $('#cart-wp').html(data);
                Swal.fire({
                    title: 'Đã thêm vào giỏ hàng thành công',
                    text: "Bạn có thể mua hàng tiếp hoặc tiến hành thanh toán",
                    showCancelButton: true,
                    confirmButtonColor: 'rgb(51 167 43)',
                    confirmButtonText: 'Đến giỏ hàng',
                    cancelButtonText: 'Mua tiếp',
                    cancelButtonColor: '#3085d6',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = url_cart_show;
                    }
                });
            }
        });

        // alert(url);

    })
})
