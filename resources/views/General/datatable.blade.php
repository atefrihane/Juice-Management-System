<script>
    if ($(".date-create")[0]) {
        var oTable = $('.table').DataTable({
            responsive: true,
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
            },
            "bLengthChange": false,
            "columnDefs": [{
                    "targets": -1,
                    "orderable": false,
                     },
                     {"targets": ".is-wrapped",    render: function ( data, type, row ) {
                        if (data.length > 50)
                            {
                                return data.substr( 0, 50 )+'...';

                            }
                            else{
                                return data.substr( 0, 50 );
                            }
        }},
                     ],

            order: [
                [$('th.date-create').index(), 'desc']
            ],

            "pageLength": 20,

        });
    } else {
        var oTable = $('.table').DataTable({
            responsive: true,
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
            },
            "bLengthChange": false,
            "columnDefs": [{
                    "targets": -1,
                    "orderable": false,
                        },
                        {"targets": "is-wrapped",   render: function ( data, type, row ) {
                            if (data.length > 50)
                            {
                                return data.substr( 0, 50 )+'...';

                            }
                            else{
                                return data.substr( 0, 50 );
                            }
          
        }},

                    ],

            "pageLength": 20,

        });
    }

</script>
