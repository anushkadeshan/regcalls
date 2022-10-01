<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import UsersTable from './UsersTable.vue';
export default {
    props: {
        users: Object
    },
    data () {
        return {
            crumbs: ['Users','All']
        }
    },
    components : {
        AppLayout,
        UsersTable
    }
}
</script>

<template lang="">
    <AppLayout title="Users" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <UsersTable :users="users"></UsersTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="">

</style>
