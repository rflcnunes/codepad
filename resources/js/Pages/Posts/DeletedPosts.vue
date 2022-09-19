<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Post from '@/Components/Post.vue';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { useForm, Head } from '@inertiajs/inertia-vue3';

    defineProps(['deleted_posts']);
    </script>

    <template>
        <Head title="Deleted Posts" />

        <AuthenticatedLayout>
            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <h1>Deleted Posts</h1>
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <Post
                        v-for="post in deleted_posts"
                        :key="post.id"
                        :post="post"
                    />
                </div>
            </div>
        </AuthenticatedLayout>
    </template>
