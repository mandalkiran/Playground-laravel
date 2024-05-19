<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import {ref, onMounted} from "vue";

const messages = ref([]);
const data = ref("");
const submit = () => {
    router.post('/chat', {
        'data': data.value
    })
    data.value = "";
}

onMounted(()=> {
    Echo.channel('cleavr')
        .listen('MessageEvent', (event) => {
           messages.value.push(event.message);
        });
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reverb Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <ul class="p-6 text-gray-900">
                        <li v-for="msg in messages">{{msg}}</li>
                    </ul>
                    <form  @submit.prevent="submit">
                        <div class="flex">
                            <input class="flex-1" v-model="data"/>
                            <button type="submit" class="mx-3">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
