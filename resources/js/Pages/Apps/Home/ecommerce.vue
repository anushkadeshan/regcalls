<script>
import AppLayout from '../../../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';

export default {
    components: { AppLayout, Link },
    props :{
        title : String,
        theme :Object,
    },
    data() {
        return {
            crumbs : ['Apps','Ecommerce']
        }
    },
}
</script>
<style scoped>
    .active-menu {
        background-color: v-bind('theme.menu_active_color');
        color: white;
    }
    .active-menu:hover{
        background-color: v-bind('theme.menu_active_color');
        opacity: 0.8;
        color:white;
    }
</style>
<template>
    <AppLayout :title="title" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="grid grid-cols-4 gap-2">
                        <Link v-if="$page.props.currentPermissions.includes('View Stock')" :href="route('stock.index')">
                            <div class="p-2 active-menu rounded-md text-white text-center cursor-pointer">
                                {{ $t('Stock Management') }}
                            </div>
                        </Link>
                        <Link v-if="$page.props.currentPermissions.includes('View Category')" :href="route('category.index')">
                            <div class="p-2 active-menu rounded-md text-white text-center cursor-pointer">
                                {{ $t('Category Management') }}
                            </div>
                        </Link>
                        <Link v-if="$page.props.currentPermissions.includes('View Attribute')" :href="route('attribute.index')">
                            <div class="p-2 active-menu rounded-md text-white text-center cursor-pointer">
                                {{ $t('Attribute Management') }}
                            </div>
                        </Link>
                        <Link v-if="$page.props.currentPermissions.includes('View Product')" :href="route('product.index')">
                            <div class="p-2 active-menu rounded-md text-white text-center cursor-pointer">
                                {{ $t('Product Management') }}
                            </div>
                        </Link>

                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="">

</style>
