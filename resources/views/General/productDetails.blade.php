<script>
    $('document').ready(function () {
        
        localStorage.removeItem("id");
        $('.selected_product').on('change', function () {

            var id = this.value;
            localStorage.removeItem("id");
            $('.creation_date').val('');
            $('.expiration_date').val('');
     

            localStorage.setItem("id", id);
            var url = {!!json_encode(url('/'))!!}

            if (id == 0) {
                $('#productCode').val('');
                $('#barCode').val('');
                $('#packing').val('');

            } else {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url + '/api/product/details/' + id,
                    dataType: 'json',
                    success: function (data) {
                        var response = JSON.parse(JSON.stringify(data));

                        $('#productCode').val(response.product.code);
                        $('#barCode').val(response.product.barcode);
                        $('#productPrice').val(response.product.public_price);
                        $('#defaultDisplay').val(response.product.unit_by_display);
                        $('#defaultPacking').val(response.product.unit_per_package);
                        $('#packing').val(response.product.packing);
                        $('#packing1').val(response.product.packing);

                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            }

        });


        if($('.creation_date').val()) {
            let value = $('.creation_date').val();
            let id = $('.selected_product :selected').val();
            var url = {!!json_encode(url('/'))!!}

            if(value.length > 0)
            {
                $.ajax({

                type:'POST',
                headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url:url + `/api/product/${id}/validity`,

                data:{date:value},

                success:function(data){

                    var response = JSON.parse(JSON.stringify(data));
                    $('.expiration_date').val(response.finalDate)
                
                }

                });

            }
            else{
                $('.expiration_date').val('');


            }
        }


        $('.creation_date').on('change', function () {
          
            let value = this.value;
            let id = $('.selected_product :selected').val();
            var url = {!!json_encode(url('/'))!!}

            if(value.length > 0)
            {
                $.ajax({

                type:'POST',
                headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url:url + `/api/product/${id}/validity`,

                data:{date:value},

                success:function(data){

                    var response = JSON.parse(JSON.stringify(data));
                    $('.expiration_date').val(response.finalDate)
                
                }

});

            }
            else{
                $('.expiration_date').val('');


            }


             
            

        });

    });

</script>

<script>
    $('.selectAll').click(function () {

        if ($(this).prop("checked")) {
            $(".willCheck").prop("checked", true);
        } else {
            $(".willCheck").prop("checked", false);
        }
    })

</script>
