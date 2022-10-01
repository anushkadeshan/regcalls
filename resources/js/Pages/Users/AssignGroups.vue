<script>
import { trans } from 'laravel-vue-i18n';

export default {
    props : {
        groups : Object,
        user_id : Number,
        assignedGroups : Object
    },

    methods: {
        submitGroup : function (e) {
            this.$inertia.visit(route('users.assignGroupsToUser'),{
                method: 'post',
                data : {
                    group_id : e.target.value,
                    user_id : this.user_id
                },
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },

            })
        },
        removeGroup : function (group_id,user_id) {
            this.$inertia.visit(route('users.removeGroups'),{
                method: 'post',
                data : {
                    group_id : group_id,
                    user_id : user_id
                },
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },

            })
        }
    },
}
</script>
<template lang="">
    <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6 my-4">
        <div class="md:flex md:flex-row md:space-x-10">
            <div class="w-full md:mb-0 mb-4">
                <h5 class="font-medium my-2">{{$t('Current Groups')}}</h5>
                <div v-for="group in assignedGroups" ::key="group.id" class="flex flex-row border-b border-gray-300 my- py-1 items-center">
                    <span >
                        [{{group.id}}] {{group.name}}
                    </span>
                    <button @click="removeGroup(group.id,user_id)" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <div class="w-full">
                <h5 class="font-medium my-2">{{$t('Assign Groups to User')}}</h5>
                <div class="w-full">
                    <select @change="submitGroup($event)" class="w-full my-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="">{{$t('Select a Option')}}</option>
                        <option v-for="group in groups" :key="group.id" :value="group.id">{{group.name}}</option>
                    </select>
                </div>
            </div>
        </div>

    </div>
</template>

<style lang="">

</style>
