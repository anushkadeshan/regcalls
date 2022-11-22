<script>
import Footer from '../Components/client/Footer.vue'
import Header from '../Components/client/Header.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';
import Navbar from '../Components/client/Navbar.vue';

export default {
    props:{
        title: String,
    },
    components:{
        Header,
        Navbar,
        Head, Footer
    }
}
</script>
<template lang="">
    <Head :title="title" ></Head>
    <Header></Header>
    <Navbar></Navbar>
    <slot></slot>
    <Footer></Footer>
</template>

<style scoped>
</style>
