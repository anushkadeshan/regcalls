<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import DatabaseTable from './DatabaseTable.vue';
import { trans } from 'laravel-vue-i18n';
import PermissionError from '../../Components/pages/PermissionError.vue';

export default {
    props : {
        databases : Object
    },
    components : {
        AppLayout,
        DatabaseTable,
        PermissionError
    },

    data() {
        return {
            crumbs : ['Databases','All']
        }
    },

    methods: {
        syncTables : function () {
            this.$inertia.get(this.route('databases.sync'), {
                replace :true,
                preserveState : true,
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },

                onError: (errors) => {
                    console.log(errors);
                },
            })
        }
    },
}
</script>
<template lang="">
    <AppLayout title="Databases" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="flex justify-end" v-show="$page.props.currentPermissions.includes('Sync Tables')">
                        <button class="bg-gray-800 hover:bg-gray-700 transition-color duration-300 delay-100 text-white rounded px-4 py-2" id="show-modal" @click="syncTables">
                            <div class="flex space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                                <span>{{ $t('Sync Tables') }}</span>

                            </div>

                        </button>
                    </div>
                    <DatabaseTable v-if="$page.props.currentPermissions.includes('View Databases')" :databases="databases"></DatabaseTable>
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
