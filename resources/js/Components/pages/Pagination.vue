<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    props:{
        links : Array,
        from_items : Number,
        to_items : Number,
        total_items :Number
    },

    components:{
        Link
    }
}
</script>
<template>
    <div v-if="links.length >  3" class="my-2 md:flex justify-between items-center">
        <div class="text-gray-700 text-sm md:text-base md-my-0 my-2">
            Showing {{from_items}} to {{to_items}} of {{total_items}} results
        </div>
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null" :key="key" class="mb-1 mr-1 md:px-4 md:py-3 px-2 py-3 text-gray-400 text-sm leading-4 border rounded" v-html="link.label" />
                <Link v-else :key="`link-${key}`" class="mb-1 mr-1 md:px-4 md:py-3 px-3 py-3 focus:text-indigo-500 text-sm leading-4 hover:bg-white border focus:border-indigo-500 rounded" :class="{ 'bg-gray-200': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

<style lang="">

</style>
