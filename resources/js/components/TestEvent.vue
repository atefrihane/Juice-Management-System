<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

            window.Echo.private(`user-${this.user.id}`)
                .notification((notification) => {
                    alert('lol')
                    console.log(notification);
                });



            // window.Echo.private('user-.1')
            //     .listen('.NewMessage', (e) => {
            //         alert('yes')
            //     });


        },
            props: ['user'],
    }

</script>
