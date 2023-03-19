<template>
    <Head title="Edit Blog" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Blog
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="form.put(route('blogs.update', form.id))" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control"
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
                            class="form-control"
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
                            class="form-control"
                            id="image"
                        />
                        <InputError class="mt-2" :message="form.errors.image" />
                    </div>

                        <Link class="btn btn-dark m-2" :href="route('blogs.index')">Cancel</Link>
                        <button class="btn btn-success m-2">Save</button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from '@/Components/InputError.vue';
import { Link, Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    blog: {
        type: Object,
        default: () => ({}),
    },
    errors:{
        type: Object,
        default: () => ({}),
    }
});
const form = useForm({
            id: props.blog.id,
            title: props.blog.title,
            body: props.blog.body,
        });
</script>
