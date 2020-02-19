<template>
<div>
    <Header />
</div>
</template>
<script>
import Header from './header.vue'
    export default {
         components: {
            Header
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>