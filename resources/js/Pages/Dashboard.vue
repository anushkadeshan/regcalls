<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

const crumbs = [];

</script>

<template>
    <AppLayout title="Dashboard" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="grid md:grid-cols-3 grid-cols-1">
                    <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4 m-2">
                        <img :src="'/storage/Root/Apps/Images/Q5HseRfJfbLVQy2YniiXCgTQjuUTxY7QKYWUsoJt.jpg'" alt="">
                        <p class="text-center my-2 text-gray-800">Regcalls</p>
                        <p class="text-center my-2 text-gray-500">Regcalls sdsdsdsd sdsdsds sdsdsds sdsds sdsd</p>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
