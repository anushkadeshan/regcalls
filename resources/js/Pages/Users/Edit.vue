<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { trans } from 'laravel-vue-i18n';
import AssignGroups from './AssignGroups.vue';
import AssignProfiles from './AssignProfiles.vue';
import PermissionError from '../../Components/pages/PermissionError.vue';

export default {
    props : {
        user : Object,
        profiles : Object,
        groups : Object,
        assignedProfiles : Array
    },
    data () {
        return {
            crumbs : ['Users','Edit',this.user.name],
            isActive : this.user.isActive ? true : false,
            profile : '',
            form : this.$inertia.form({

            })
        }
    },

    components: {
        AppLayout,
        AssignGroups,
        AssignProfiles,
        PermissionError
    },

    methods : {
        changeStatus : function (event) {
            this.$inertia.visit(route('users.changeStatus'),{
                method: 'post',
                data : {
                    user_id : this.user.id,
                    status : event.target.value
                },
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                    this.showDeleteModal = false;
                    this.form.reset();
                },

            })
        },
    }

}
</script>

<template lang="">
    <AppLayout title="Users" :crumbs="crumbs">
        <div class="py-6 px-2" v-if="$page.props.currentPermissions.includes('Edit User')">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="flex justify-between">
                        <p class="text-gray-800 font-bold">{{$t('Edit User Details')}}</p>
                        <label for="default-toggle" class="inline-flex relative items-center mb-4 cursor-pointer">
                            <input type="checkbox" @change="changeStatus($event)" v-model="isActive" :value="isActive" id="default-toggle" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-400"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{$t('User Active')}}</span>
                        </label>
                    </div>
                </div>

                <AssignGroups v-if="$page.props.currentPermissions.includes('Assign Groups to User')" :groups="groups" :user_id="user.id" :assignedGroups="user.groups"></AssignGroups>

                <AssignProfiles v-if="$page.props.currentPermissions.includes('Assign Profiles to User')" :profiles="profiles" :user_id="user.id" :assignedProfiles="assignedProfiles"></AssignProfiles>

            </div>
        </div>
        <div v-else>
            <PermissionError></PermissionError>
        </div>
    </AppLayout>
</template>

<style lang="">

</style>
