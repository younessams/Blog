<template>
    <Head title="New Blog" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Blog
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            class="w-full"
                            id="title"
                            v-model="form.title"
                            placeholder="create title"
                        />
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label"
                            >Body</label
                        >
                        <textarea
                            class="w-full"
                            id="body"
                            rows="3"
                            v-model="form.body"
                        ></textarea>
                        <InputError class="mt-2" :message="form.errors.body" />
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input
                            type="file"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            @input="form.image = $event.target.files[0]"
                            id="image"
                        />
                        <progress class="w-full" v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                        <InputError class="mt-2" :message="form.errors.image" />
                    </div>

                        <Link class="px-6 py-2 text-white bg-gray-900 rounded mr-2" :href="route('blogs.index')">Cancel</Link>
                        <button class="px-6 py-2 text-white bg-gray-900 rounded">Create</button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from '@/Components/InputError.vue';
import { Link, Head, useForm } from "@inertiajs/vue3";

defineProps({ errors: Object })

const form = useForm({
            title: null,
            body: null,
            image: null,
        });
        
function submit(){
    form.post('/blogs')
}
</script>
