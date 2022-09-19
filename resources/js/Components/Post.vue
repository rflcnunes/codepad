<script setup>
    import dayjs from 'dayjs';
    import relativeTime from 'dayjs/plugin/relativeTime';
    import Dropdown from '@/Components/Dropdown.vue';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import { useForm } from '@inertiajs/inertia-vue3';
    import { ref } from 'vue';

    dayjs.extend(relativeTime);

    const props = defineProps(['post']);

    const form = useForm({
    message: props.post.message,
    });

    const editing = ref(false);
    </script>

    <template>
        <div class="p-6 flex space-x-2">
            <img class="h-10 w-10" src="../../css/alien-monster_1f47e.png" alt="alien">
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-800">{{ post.user.name }}</span>
                        <small class="ml-2 text-sm text-gray-600">{{ dayjs(post.created_at).fromNow() }} &middot; created</small>
                        <small v-if="post.created_at !== post.updated_at && !post.deleted_at" class="text-sm text-gray-600"> &middot; edited</small>
                        <small v-if="post.deleted_at" class="ml-2 text-sm text-gray-600">{{ dayjs(post.deleted_at).fromNow() }} &middot; deleted</small>
                    </div>
                    <Dropdown v-if="post.user.id === $page.props.auth.user.id && !post.deleted_at">
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <button class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out" @click="editing = true">
                            Edit
                        </button>
                        <DropdownLink as="button" :href="route('posts.destroy', post.id)" method="delete">
                            Delete
                        </DropdownLink>
                    </template>
                </Dropdown>
                </div>
                <form v-if="editing" @submit.prevent="form.put(route('post.update', post.id), { onSuccess: editing = false })">
                <textarea v-model="form.message" class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset()">Cancel</button>
                </div>
                </form>
                <p class="mt-4 text-lg text-gray-900">{{ post.message }}</p>
            </div>
        </div>
    </template>
