<script>
import { trans } from 'laravel-vue-i18n';
export default {
    props : {
        theme : Object
    },
    methods: {
        changeProfile : function(role_id) {
            this.$inertia.visit(route('users.changeProfile'),{
                method: 'post',
                data : {
                    role_id : role_id,
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
    <div class="mx-2 md:mx-4">
        <div class="group inline-block relative">
            <button :class="theme.menu_color"
            class="bg-gray-200 text-sm md:text-base text-gray-700 md:font-semibold py-2 px-4 rounded inline-flex items-center"
            >
            <span class="mr-1">{{$page.props.profileName}}</span>
                <svg  v-if="$page.props.assignedProfiles.length >0"
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    />
                </svg>
            </button>
            <ul v-if="$page.props.assignedProfiles.length >0" class="w-48 absolute rounded-lg hidden text-gray-700 pt-1 z-50 group-hover:block transform transition-transform duration-500 ease-in-out">
                <li class="">
                    <a :style="'background-color:'+theme.menu_active_color"
                    class="bg-gray-400 text-white font-medium py-2 px-4 block whitespace-no-wrap"
                    href="#">{{$t('Profiles')}}</a>
                </li>
                <li v-for="(profile, key) in $page.props.assignedProfiles" ::key="key" class="">
                    <a @click="changeProfile(profile.id)"
                    :class="theme.menu_color, theme.menu_hover_color"
                    class="bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-no-wrap"
                    href="#"> {{profile.name}}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<style lang="">

</style>
