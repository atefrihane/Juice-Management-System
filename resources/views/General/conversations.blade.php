<script>


 $('.company').on('change', function () {
    var url = {!!json_encode(url('/')) !!}
    $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: url + '/api/company/'+this.value+'/contacts',
            dataType: 'json',
            success: function (data) {
                var response = JSON.parse(JSON.stringify(data));
                let html="";
              
                if(response.status == 200)
                {
         
                if(response.contacts.length > 0)
                {
                    for (var i = 0; i < response.contacts.length; i++) {

                        html += '<option value="' + response.contacts[i].user.id + '" class="foobar">' + response.contacts[i].user.nom[0].toUpperCase() + response.contacts[i].user.nom.slice(1)+' '+ response.contacts[i].user.prenom[0].toUpperCase() + response.contacts[i].user.prenom.slice(1)+'</option>'
                        $('.contact').html(html);
                    }
                }
                else {
                    html += '<option value="" class="foobar">Aucun contact</option>'
                    $('.contact').html(html);

                }

                }

                if(response.status == 400)
                {
                    html += '<option value="" class="foobar">Aucun contact</option>'
                    $('.contact').html(html);
                }
            



            },
            error: function (data) {
                console.log(data);
            }
        });
 });

</script>