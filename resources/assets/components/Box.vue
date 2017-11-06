<template>
    <div class="prompt-box" v-bind:class="{ show: status }">
        <p>{{message}}</p>
    </div>

</template>

<script>
    import Bus from './bus.js';

    export default {
        data() {
            return {
                status : false,
                message : ''
            }
        },

        created() {
            Bus.$on('box', (message) => {
                this.status = true;
                this.message = message;
            });
        },

        watch : {
            status(val){
                if (val){
                    setTimeout(() => {
                        this.status = false;
                    }, 2000);
                }
            }
        }
    }
</script>

<style>

</style>