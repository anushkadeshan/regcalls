<script>
export default {
    props:{
        categories : Object
    },
    data() {
        return {

        }
    },
}
</script>
<template lang="">
    <div class="md:px-16 md:py-16 px-6 py-6">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6 md:text-left text-center">{{$t('shop by category')}}</h2>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-3">
            <div v-for="(category, index) in categories" :key="category.id" class="relative rounded-sm overflow-hidden group">
                <img :src="'/storage/'+category.image" :alt="category.name" class="w-full max-h-64">
                <a href="#"
                    class="absolute inset-0 bg-black opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:opacity-60 transition">
                    {{category.name}}
                </a>
            </div>
        </div>
    </div>
</template>

<style lang="">

</style>
