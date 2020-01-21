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
                <tr v-for="bal in balance" v-if="balance2.length > 0">

                    <td class="text-left">{{bal.name}} </td>
                    <td class="text-left">{{bal.qty }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"
                            class="form-check-input" id="exampleCheck1" :checked="bal.active"> </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            
            if (this.balance){
            console.log('Component mounted.')
            console.log(JSON.parse(this.balance))
            }else{
                console.log("still waiting")
            }
        },
        data() {
            return {
                balance2: [
                    {name: "aze", qty: 45},
                    {name: "qsd", qty: 20},
                ]
            }


        },
        props: ['balance']


    }

</script>
