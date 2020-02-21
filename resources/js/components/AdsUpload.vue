<template>
    <div>
        <section class="content" style="margin-top:20px;">
            <div class="row">
                <div class="container-fluid">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Importer une régie publicitaire</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions">
                                    </vue-dropzone>
                                </div>
                                <div class="form-group text-center">

                                    <button type="submit" id="button" class="btn btn-primary">Importer</button>
                                </div>


                            </div>


                        </form>
                    </div>


                </div>

            </div>

        </section>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        components: {
            vueDropzone: vue2Dropzone
        },

        mounted() {
            axios.get('/api/photos/all')
                .then((response) => {
                    // handle success
                    console.log(response);
                    if (response.data.ads.length > 0) {

                        let ads = response.data.ads
                        ads.forEach(ad => {
                            var file = {
                                size: ad.size,
                                name: ad.path,
                                value: ad.id
                            };
                            this.$refs.myVueDropzone.manuallyAddFile(file, '/img/' + ad.path);
                        })
                    }
                })
                .catch((error) => {
                    // handle error
                    console.log(error);
                })



            //  var file = { size: 123, name: "Icon", type: "image/png" };
            // var url = "/img/1579188620.png";
            // this.$refs.myVueDropzone.manuallyAddFile(file, url);
        },
        data() {
            return {
                dropzoneOptions: {
                    url: "/api/photos/upload",
                    thumbnailWidth: 150,
                    maxFilesize: 3,
                    addRemoveLinks: true,

                    dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>&nbsp;Importer une photo",
                    dictRemoveFile: 'Retirer',
                    dictFileTooBig: 'Fichier volumineux',
                    acceptedFiles: "image/jpeg,image/png",
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    },
                    autoProcessQueue: false,
                    init: function () {

                        var myDropzone = this;


                        $("#button").click(function (e) {
                            e.preventDefault();
                            myDropzone.processQueue();
                        });


                    },



                    removedfile: function (file) {
                        let name = file.name;

                        axios.get(`/api/photo/name/${name}`)
                            .then((response) => {
                                if (response.data.status == 200) {
                                    var _ref;
                                    if (file.previewElement) {
                                        if ((_ref = file.previewElement) != null) {
                                            _ref.parentNode.removeChild(file.previewElement);
                                        }
                                    }
                                    return this._updateMaxFilesReachedClass();

                                }
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                             var _ref;
                        if (file.previewElement) {
                            if ((_ref = file.previewElement) != null) {
                                _ref.parentNode.removeChild(file.previewElement);
                            }
                        }
                        return this._updateMaxFilesReachedClass();

                    }



                },
                ads: []


            }
        }
    }

</script>
