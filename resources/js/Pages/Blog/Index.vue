<template>
    <Head title="Blogs" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Blogs
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    id="message"
                    v-if="$page.props.flash.message"
                    class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert"
                >
                    <span class="font-medium">
                        {{ $page.props.flash.message }}
                    </span>
                    <span
                        id="remove-item"
                        @click="removeTagMessage"
                        class="remove-item"
                    >
                        X
                    </span>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Link
                        class="new-post inline-flex px-4 py-2 bg-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        :href="route('blogs.create')"
                    >
                        <i class="fa-solid fa-circle-plus mr-4"></i>
                        Add New Blog
                    </Link>
                    <div v-if="blogs.length > 0" class="container shadow-xl">
                        <table class="table table-hover rounded-lg w-full p-2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Body</th>
                                    <th scope="col">Show</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(blog, i) in blogs" :key="i">
                                    <th scope="row">{{ i + 1 }}</th>
                                    <td><img class="w-14 h-14 rounded" :src="blog.image ? 'images/blogs/'+blog.image :'images/image.jpg'" :alt="blog.title" /></td>
                                    <td>{{ blog.title }}</td>
                                    <td>{{ blog.body }}</td>
                                    <td>
                                        <Link
                                            :href="route('blogs.show', blog.id)"
                                            class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                        <i class="fa-solid fa-eye"></i>
                                        </Link>
                                    </td>
                                    <td>
                                        <Link
                                            :href="route('blogs.edit', blog.id)"
                                            class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            <i class="fa-solid fa-edit"></i>
                                        </Link>
                                    </td>
                                    <td>
                                        <DangerButton
                                            type="button"
                                            class="bt text-white bg-red-600 w-4"
                                            @click="destroy(blog.id, i)"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </DangerButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav v-if="links.length > 77" class="">
                            <ul class="flex">
                                <li
                                    v-for="(link, p) in links"
                                    :key="p"
                                    class="mr-2"
                                >
                                    <Link
                                        class=""
                                        :href="link.url"
                                        v-html="link.label"
                                    ></Link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div v-else class="grid gap-4 content-center justify-items-center bg-slate-100 shadow-2xl h-24">
                        <p class=" text-slate-800 text-lg">No Blogs available</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { useForm, Head, router, Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
    blogs: {
        type: Object,
        default: () => ({}),
    },
});

const blogs = props.blogs.data;
const links = props.blogs.links;

// blogs.push({id: 1, title: 'Youness Amasri', body:'Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe aliquid, nostrum quam dolorem in repellat consequuntur est culpa, obcaecati perspiciatis illo ducimus ratione reprehenderit vero omnis provident suscipit consectetur assumenda!'})

const removeTagMessage = () => (usePage().props.flash.message = null);

const destroy = (id, index) => {
    router.delete(route("blogs.destroy", id));
    router.on("finish", (event) => blogs.splice(index, 1));
};
</script>

<style lang="scss" scoped>
.remove-item {
    position: absolute;
    right: 9%;
    cursor: pointer;
}

.bt {
    margin: 0;
    padding: 0;
    width: 80px;
    height: 30px;
    justify-content: center;
}

.new-post {
    display: flex;
    margin: 10px;
    font-size: 30px;
    justify-content: center;
    align-items: center;
    height: 56px;
    background-color: #44df31;
}
</style>
