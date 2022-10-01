<script>
import Pagination from "../../Components/pages/Pagination.vue";
import PermissionError from "../../Components/pages/PermissionError.vue";
export default {
    props: {
        roles: Object
    },
    components: { Pagination, PermissionError }
}
</script>

<template>
    <div class="my-4" v-if="$page.props.currentPermissions.includes('View Roles')">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Role Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Guard
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="roles.data.length >0" v-for="(role, key) in roles.data" :key="role.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{role.name}}
                        </th>
                        <td class="py-2 px-6">
                            {{role.guard_name}}
                        </td>
                    </tr>
                    <div v-else class=" my-4 mx-4">
                        {{$t('No Data Found')}}
                    </div>
                </tbody>
            </table>
        </div>
        <Pagination :links="roles.links" :to_items="roles.to" :from_items="roles.from" :total_items="roles.total"></Pagination>
    </div>
    <div v-else>
        <PermissionError></PermissionError>
    </div>
</template>

<style lang="">

</style>
