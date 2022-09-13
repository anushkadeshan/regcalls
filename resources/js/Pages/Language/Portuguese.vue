<script setup>
    import en from '/lang/pt.json';
    </script>

    <template>
        <div class="md:overflow-y-auto md:h-96">
            <ul>
                <li v-for="(value, key) in en"  :key="key">
                    {{key}} : {{value}}
                </li>
            </ul>
        </div>

    </template>
