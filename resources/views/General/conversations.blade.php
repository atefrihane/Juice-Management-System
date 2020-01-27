<script>
    $('.company').on('change', function () {
        var url = {!!json_encode(url('/'))!!}
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: url + '/api/company/' + this.value + '/contacts',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            dataType: 'json',
            success: function (data) {
                var response = JSON.parse(JSON.stringify(data));
                let html = "";

                if (response.status == 200) {

                    if (response.contacts.length > 0) {
                        html+='<option value="">Séléctionner un contact </option>';
                        for (var i = 0; i < response.contacts.length; i++) {

                            html += '<option value="' + response.contacts[i].user.id +
                                '" class="foobar">' + response.contacts[i].user.nom[0]
                                .toUpperCase() + response.contacts[i].user.nom.slice(1) + ' ' +
                                response
                                .contacts[i].user.prenom[0].toUpperCase() + response.contacts[i]
                                .user.prenom.slice(1) + '</option>'
                            $('.contact').html(html);
                        }
                    } else {
                        html += '<option value="" class="foobar">Aucun contact</option>'
                        $('.contact').html(html);

                    }

                }

                if (response.status == 400) {
                    html += '<option value="" class="foobar">Aucun contact</option>'
                    $('.contact').html(html);
                }

            },
            error: function (data) {
                console.log(data);
            }
        });
    });



    $('.dot').each((index, element) => {
        $(element).click(function () {
            let url = {!!json_encode(url('/'))!!}
            let parent = $(this).closest('.box')
            let id = $(parent).attr("data-id")
            let value = "";
            let remove = false;
            if (parent.hasClass('box-bg')) {
                value = 1
                remove = true
            } else {
                value = 0
                remove = false;
            }
      

            $.ajax({

                type: 'POST',

                url: url + `/conversation/${id}/seen`,
                headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                data: {
                    value
                },

                success: function (data) {

                    var response = JSON.parse(JSON.stringify(data));
                    switch (response.status) {
                        case 200:
                            if (remove) {
                                parent.removeClass('box-bg')
                            } else {
                                parent.addClass('box-bg')

                            }
                            break;
                    }

                }

            });



        })
    });

</script>
