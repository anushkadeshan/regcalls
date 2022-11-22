<script>
import ProductsTable from './ProductsTable.vue'
import { Link } from '@inertiajs/inertia-vue3';
import PermissionError from '../../../../Components/pages/PermissionError.vue';
import AppLayout from '../../../../Layouts/AppLayout.vue';


export default {
    props :{
        products : Object
    },
    data() {
        return {
            crumbs : ['Ecommerce','Products','All']
        }
    },
    components: {
        AppLayout,
        Link,
        PermissionError,
        ProductsTable
    }
}
</script>
<template lang="">
    <AppLayout title="Products" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="flex justify-end"  v-show="$page.props.currentPermissions.includes('Create Stock')">
                        <Link :href="route('product.create')">
                            <button class="bg-gray-800 hover:bg-gray-700 transition-color duration-300 delay-100 text-white rounded px-4 py-2" id="show-modal" >{{ $t('Add New') }}</button>
                        </Link>
                    </div>
                    <ProductsTable v-if="$page.props.currentPermissions.includes('View Product')" :products="products"></ProductsTable>
                    <div v-else>
                        <PermissionError></PermissionError>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="">

</style>
