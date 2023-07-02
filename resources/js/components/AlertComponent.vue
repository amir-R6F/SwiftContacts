<template>
    <b-alert
        dismissible
        :variant="states === 1 ? 'success' : 'danger'"
        :show="counter"
        @dismissed="counter = 0"
        @dismiss-count-down="counterAlert"
    >{{ messages }}
    </b-alert>
</template>

<script>
import event from "../event";

export default {
    name: "AlertComponent.vue",
    data(){
        return{
            secend: 5,
            counter: 0,
            states: 0,
            messages: null,
        }
    },
    methods:{
        counterAlert(c) {
            this.counter = c;
        },
        showalert() {
            this.counter = this.secend;
        },
        statealert(val) {
            this.states = val;
            this.showalert();
        },
    },
    created() {
        event.$on('showAlert', (res)=>{
            this.messages = res.message;
            this.statealert(res.state);
        });
    }

}
</script>

<style scoped>

</style>
