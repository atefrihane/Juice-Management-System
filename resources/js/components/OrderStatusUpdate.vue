<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Mise à jour etat </h3>

        </div>

        <form role="form">
            <div class="box-body">
                <div class="box-body">
                    <div class="alert alert-danger" v-if="errors.length>0">
                        <ul>

                            <li v-for="error in errors">{{error}}</li>

                        </ul>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input class="form-control" id="disabledInput" type="text" v-model="order_id" disabled>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Code</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="code" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Etat actuel</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Code.."
                                    v-model="formated_status" disabled>
                            </div>
                        </div>

                    </div>

                    <order-to-prepare 
                         v-if="status == 2" 
                         :order_id="this.order_id" 
                         :user_id="this.user_id"
                         :is_preparator="this.is_preparator"
                         v-on:requiredValue="updateError($event)">
                     </order-to-prepare>

                    <order-in-prepare 
                        v-if="status == 3" 
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        v-on:requiredValue="updateError($event)"> 
                    </order-in-prepare>

                    <order-prepared 
                        v-if="status == 4" 
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        :order_full="this.order_full"
                        :history="this.history"
                        v-on:requiredValue="updateError($event)"> 
                    </order-prepared>

                    <order-to-deliver 
                        v-if="status == 5" 
                        :order_full="this.order_full"
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        :history="this.history"
                         v-on:requiredValue="updateError($event)">
                    </order-to-deliver>

                    <order-in-delivering 
                        v-if="status == 6" 
                        :order_full="this.order_full"
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        :history="this.history"
                         v-on:requiredValue="updateError($event)">
                    </order-in-delivering>

                    <order-delivered 
                        v-if="status == 7" 
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        :history="this.history"
                        v-on:requiredValue="updateError($event)">
                     </order-delivered>

                    <order-for-bill 
                        v-if="status == 8" 
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        v-on:requiredValue="updateError($event)">
                     </order-for-bill>

                    <order-billed 
                        v-if="status == 9" 
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        v-on:requiredValue="updateError($event)"> 
                    </order-billed>

                    <order-sent-account 
                        v-if="status == 10" 
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        v-on:requiredValue="updateError($event)">
                      </order-sent-account>
                        
                    <order-accounting 
                        v-if="status == 11" 
                        :order_id="this.order_id" 
                        :user_id="this.user_id"
                        v-on:requiredValue="updateError($event)"> 
                    </order-accounting>

                </div>




            </div>





        </form>


    </div>
</template>

<script>
    import OrderToPrepare from '../components/nested/OrderToPrepare.vue'
    import OrderInPrepare from '../components/nested/OrderInPrepare.vue'
    import OrderPrepared from '../components/nested/OrderPrepared.vue'
    import OrderToDeliver from '../components/nested/OrderToDeliver.vue'
    import OrderInDelivering from '../components/nested/OrderInDelivering.vue'
    import OrderDelivered from '../components/nested/OrderDelivered.vue'
    import OrderForBill from '../components/nested/OrderForBill.vue'
    import OrderBilled from '../components/nested/OrderBilled.vue'
    import OrderSentAccount from '../components/nested/OrderSentAccount.vue'
    import OrderAccounting from '../components/nested/OrderAccounting.vue'

    export default {
        components: {
            'order-to-prepare': OrderToPrepare,
            'order-in-prepare': OrderInPrepare,
            'order-prepared': OrderPrepared,
            'order-to-deliver': OrderToDeliver,
            'order-in-delivering': OrderInDelivering,
            'order-delivered': OrderDelivered,
            'order-for-bill': OrderForBill,
            'order-billed': OrderBilled,
            'order-sent-account': OrderSentAccount,
            'order-accounting': OrderAccounting,

        },

        mounted() {
            this.formatStatus()
        },
        props: ['order_id', 'user_id', 'status', 'code','order_full','history','is_preparator'],

        data() {
            return {

                formated_status: '',
                errors: [],
            }
        },
        methods: {

            formatStatus() {
                let status = JSON.parse(this.status)
                switch (status) {
                    case 2:

                        this.formated_status = 'A préparer';
                        break;
                    case 3:
                        this.formated_status = 'En cours de préparation';
                        break;
                    case (4):
                        this.formated_status = 'Préparée';
                        break;
                    case (5):
                        this.formated_status = 'A livrer';
                        break;
                    case (6):
                        this.formated_status = 'En cours de livraison';
                        break;
                    case (7):
                        this.formated_status = ' Livrée ';
                        break;
                    case (8):
                        this.formated_status = ' A facturer ';
                        break;
                    case (9):
                        this.formated_status = 'Facturée ';
                        break;
                    case (10):
                        this.formated_status = 'A envoyer en comptabilité';
                        break;
                    case (11):
                        this.formated_status = 'Comptabilisée';
                        break;
                    case (12):
                        this.formated_status = 'Annulée';
                        break;
                  

                }



            },
            updateError(newError) {
                if (newError == '') {
                    this.errors = []

                } else {
                    this.errors = []
                    this.errors.push(newError)
                    window.scrollTo(0, 0);

                }




            }
        }
    }

</script>
