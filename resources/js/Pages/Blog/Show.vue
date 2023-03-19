<template>
    <Head :title="blog.title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Blogs
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                    <Link class="m-2" :href="route('blogs.index')"><i class="fa-solid fa-arrow-left"></i></Link>
                    
                    <h3 class="text-center mt-2 text-xl text-bold border-b-2 pb-2">
                        {{blog.title}}
                    </h3>
                    <div class="mt-4 mb-2 p-2 ml-4 mr-4 lightgray rounded-lg fi">
                        {{blog.body}}
                    </div>
                    <div class="flex justify-center bg-gray-500 rounded-lg">
                        <img :src="url+'/'+blog.image" :alt="blog.title">
                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, Head, router, Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const image = 'images/image.jpg'
const props = defineProps({
    blog: {
        type: Object,
        default: () => ({}),
    },
    url: {
        type:String,
        default:()=>({})
    }
});

const blog = props.blog;
const url = props.url;
</script>

<style lang="scss" scoped>
    .lightgray {
        background-color: #fbf7f7;
    }
</style>