<template>
    <div>
        <p> <b> NB : </b> Le tableau ci dessous présente les quantités restantes à préparer pour chaque produit </p>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom Produit</th>
                    <th>Quantité réstante</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(bal,index) in balance" v-if="balance.length > 0 && balance">

                    <td class="text-left"> <input type="checkbox" class="form-check-input" id="exampleCheck1"
                            :checked="bal.active" @click="disableProduct(index)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{bal.name}} </td>
                    <td class="text-left">{{bal.qty }} </td>  </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            console.log(this.balance)

        },
        data() {
            return {

            }


        },
        props: ['balance'],
        methods: {
            disableProduct(index) {
                this.balance[index].active = !this.balance[index].active
                this.$emit('update-balance', this.balance)

            }
        }


    }

</script>
