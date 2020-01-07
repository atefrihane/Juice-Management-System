<template>
    <div class="row">
        <div class="col-md-12">
            <!-- DIRECT CHAT DANGER -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{conversation.subject}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" style="height:500px" v-chat-scroll>
                        <!-- Message. Default to the left -->
                        <div v-for="message in messages">
                            <div class="direct-chat-msg" v-if=" message.type == 'Admin'">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left" style="padding-bottom:2px;">Admin </span>
                                    <span
                                        class="direct-chat-timestamp pull-right">{{ message.created_at | moment("calendar") }}</span>
                                </div>
                                <div class="direct-chat-text">
                                    {{message.content}}
                                </div>

                            </div>
                            <div class="direct-chat-msg right" v-if="message.type != 'Admin'">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right"
                                        style="padding-bottom:2px;">{{message.username}} ({{message.company}})</span>
                                    <span
                                        class="direct-chat-timestamp pull-left">{{ message.created_at | moment("calendar") }}</span>
                                </div>
                                <div class="direct-chat-text">
                                    {{message.content}}
                                </div>

                            </div>

                        </div>




                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Envoyer un message" class="form-control"
                                v-model="new_message">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat"
                                    @click.prevent="submitMessage()">Envoyer</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log()
            if (this.conversation.messages.length > 0) {
                this.conversation.messages.forEach(message => {
                    this.messages.push({
                        user_id: message.user.id,
                        content: message.message,
                        created_at: message.created_at,
                        username: message.user.nom[0].toUpperCase() + message.user.nom.slice(1) + ' ' +
                            message.user.prenom[
                                0] + message.user.prenom.slice(1),
                        seen: message.seen,
                        type: (message.user.child_type == "App\\Modules\\Admin\\Models\\Admin") ?
                            'Admin' : (message.user.child_type ==
                                "App\\Modules\\User\\Models\\Director") ? 'Directeur' :
                            'Autre',
                        company: message.user.company_name
                    })

                })

            }

        },
        props: ['conversation', 'auth_id'],
        data() {
            return {
                new_message: '',
                messages: []

            }
        },

        methods: {
            submitMessage() {

                if (this.new_message.replace(/\s/g, '').length) {
                    axios.post(`/api/conversation/${this.conversation.id}/add`, {
                            message: this.new_message,
                        })
                        .then((response) => {
                            console.log(response);
                            if (response.data.status == 200) {
                                this.messages.push({
                                    user_id: this.auth_id,
                                    content: this.new_message,
                                    created_at: Vue.moment(),
                                    username: 'Admin',
                                    seen: 0,
                                    type: 'Admin',

                                })
                                this.new_message = ''

                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });

                }
            }


        }

    }

</script>
