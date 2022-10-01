<script>
import { trans } from 'laravel-vue-i18n';

export default {
    data() {
        return {
            themes : {
                gray_light : {
                    bg : 'bg-gray-50',
                    text : 'text-gray-900',
                    menu : 'bg-gray-200',
                    menu_hover : 'hover:bg-gray-300',
                    menu_active : 'rgb(75 85 99)',
                },
                gray : {
                    bg : 'bg-gray-200',
                    text : 'text-gray-900',
                    menu : 'bg-gray-400',
                    menu_hover : 'hover:bg-gray-500',
                    menu_active : 'rgb(17 24 39)',
                },
                stone : {
                    bg : 'bg-stone-200',
                    text : 'text-gray-900',
                    menu : 'bg-stone-400',
                    menu_hover : 'hover:bg-stone-500',
                    menu_active : 'rgb(28 25 23)',
                },
                red : {
                    bg : 'bg-red-200',
                    text : 'text-gray-900',
                    menu : 'bg-red-400',
                    menu_hover : 'hover:bg-red-500',
                    menu_active : 'rgb(127 29 29)',
                },
                orange : {
                    bg : 'bg-orange-200',
                    text : 'text-gray-900',
                    menu : 'bg-orange-400',
                    menu_hover : 'hover:bg-orange-500',
                    menu_active : 'rgb(124 45 18)',
                },
                amber : {
                    bg : 'bg-amber-200',
                    text : 'text-gray-900',
                    menu : 'bg-amber-400',
                    menu_hover : 'hover:bg-amber-500',
                    menu_active : 'rgb(120 53 15)',
                },
                lime : {
                    bg : 'bg-lime-200',
                    text : 'text-gray-900',
                    menu : 'bg-lime-400',
                    menu_hover : 'hover:bg-lime-500',
                    menu_active : 'rgb(54 83 20)',
                },
                green : {
                    bg : 'bg-green-200',
                    text : 'text-gray-900',
                    menu : 'bg-green-400',
                    menu_hover : 'hover:bg-green-500',
                    menu_active : 'rgb(20 83 45)',
                },
                teal : {
                    bg : 'bg-teal-200',
                    text : 'text-gray-900',
                    menu : 'bg-teal-400',
                    menu_hover : 'hover:bg-teal-500',
                    menu_active : 'rgb(19 78 74)',
                },
                sky : {
                    bg : 'bg-sky-200',
                    text : 'text-gray-900',
                    menu : 'bg-sky-400',
                    menu_hover : 'hover:bg-sky-500',
                    menu_active : 'rgb(12 74 110)',
                },
                indigo : {
                    bg : 'bg-indigo-200',
                    text : 'text-gray-900',
                    menu : 'bg-indigo-400',
                    menu_hover : 'hover:bg-indigo-500',
                    menu_active : 'rgb(49 46 129)',
                },
                violet : {
                    bg : 'bg-violet-200',
                    text : 'text-gray-900',
                    menu : 'bg-violet-400',
                    menu_hover : 'hover:bg-violet-500',
                    menu_active : 'rgb(76 29 149)',
                },
                fuchsia : {
                    bg : 'bg-fuchsia-200',
                    text : 'text-gray-900',
                    menu : 'bg-fuchsia-400',
                    menu_hover : 'hover:bg-fuchsia-500',
                    menu_active : 'rgb(112 26 117)',
                },
                pink : {
                    bg : 'bg-pink-200',
                    text : 'text-gray-900',
                    menu : 'bg-pink-400',
                    menu_hover : 'hover:bg-pink-500',
                    menu_active : 'rgb(131 24 67)',
                },
                rose : {
                    bg : 'bg-rose-200',
                    text : 'text-gray-900',
                    menu : 'bg-rose-400',
                    menu_hover : 'hover:bg-rose-500',
                    menu_active : 'rgb(136 19 55)',
                },
            }

        }
    },

    methods: {
        SelectTheme : function(theme) {
            this.$inertia.visit(route('settings.changeTheme'),{
                method: 'post',
                data : {
                    theme : theme,
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
<template>
    <div class="py-6 px-2">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                <h2 class="font-medium my-3">{{$t('Select a Theme')}}</h2>
                <div class="grid grid-cols-6 md:grid-cols-12">
                    <div v-for="(theme, key) in themes" :key="key" class="my-2 cursor-pointer" @click="SelectTheme(theme)">
                        <div :class="theme.menu" class="h-12 mx-1">
                        </div>
                        <p class="text-center capitalize">{{key}}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style lang="">

</style>
