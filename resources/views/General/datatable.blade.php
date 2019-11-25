<script>
    if ($(".date-create")[0]) {
        var oTable = $('.table').DataTable({
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
            },
            "bLengthChange": false,
            "columnDefs": [{
                    "targets": -1,
                    "orderable": false,
                     },],

            order: [
                [$('th.date-create').index(), 'desc']
            ],

            "pageLength": 20,

        });
    } else {
        var oTable = $('.table').DataTable({
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/French.json"
            },
            "bLengthChange": false,
            "columnDefs": [{
                    "targets": -1,
                    "orderable": false,
                        },

                    ],

            "pageLength": 20,

        });
    }

</script>
