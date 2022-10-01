<script>
import Translations from './Translations.vue';

export default {
    data() {
        return {
            form: this.$inertia.form({
                lang_key: null,
                english: null,
                portuguese: null,
            }),
            crumbs: ['Translations','Add']
        };
    },
    methods: {
        submit() {
            this.form.post(route("addTranslation"), {
                preserveState: true,
                onSuccess: (page) => {
                },
            });
        }
    },
    components: { Translations }
}

</script>

<template>
    <Translations :crumbs="crumbs">
        <form class="mt-10">
            <div class="md:grid grid-cols-3 gap-6">
                <div class="my-2">
                    <label for="" class="block text-sm font-medium text-gray-700">
                        {{ $t('Key') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                    <input type="text" v-model="form.lang_key" id="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full  rounded-md sm:text-sm border-gray-300" placeholder="example">

                    </div>
                    <p class="text-red-600 text-xs" v-if="form.errors.lang_key">*{{form.errors.lang_key}}</p>
                </div>
                <div class="my-2">
                    <label for="" class="block text-sm font-medium text-gray-700">
                        {{ $t('English') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                    <input type="text" v-model="form.english" id="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full  rounded-md sm:text-sm border-gray-300" placeholder="example">

                    </div>
                    <p class="text-red-600 text-xs" v-if="form.errors.english">*{{form.errors.english}}</p>
                </div>
                <div class="my-2">
                    <label for="" class="block text-sm font-medium text-gray-700">
                        {{ $t('Portuguese') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                    <input type="text" v-model="form.portuguese" id="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full  rounded-md sm:text-sm border-gray-300" placeholder="exemplo">

                    </div>
                    <p class="text-red-600 text-xs" v-if="form.errors.portuguese">*{{form.errors.portuguese}}</p>
                </div>
            </div>
            <button @click.prevent="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                {{ $t('Add') }}
            </button>
        </form>
    </Translations>

</template>
