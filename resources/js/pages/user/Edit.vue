<script setup>

import UserController from '@/actions/App/Http/Controllers/UserController';
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import Button from '@/components/ui/button/Button.vue';
import { reactive } from 'vue';
import InputError from '@/components/InputError.vue';

const props = defineProps({
    user: Object,
});

const form = reactive({
    name: props.user.name,
    email: props.user.email,
    old_password: '',
    new_password: '',
    new_password_confirmation: '',
});

const breadcrumbItems = [
    {
        title: 'User Settings',
        href: '/user',
    },
    {
        title: 'Edit User',
    }
];

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <div class="px-4 py-6">
            <Heading title="Edit User Setting" description="Edit users and account settings" />

            <Form v-bind="UserController.update.form(user.id)" class="space-y-6"
                v-slot="{ errors, processing, recentlySuccessful }">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <Label for="name">
                            Name
                            <sup class="text-rose-600">
                                *
                            </sup>
                        </Label>
                        <Input id="name" class="mt-1 block w-full" name="name" autocomplete="name"
                            placeholder="Full name" v-model="form.name" required />
                        <InputError class="mt-2" :message="errors.name" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <Label for="name">
                            Email
                            <sup class="text-rose-600">
                                *
                            </sup>
                        </Label>
                        <Input type="email" id="email" class="mt-1 block w-full" name="email" autocomplete="email"
                            placeholder="Email address" v-model="form.email" required />
                        <InputError class="mt-2" :message="errors.email" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-4 w-full">
                        <Label for="name">
                            Old Password
                        </Label>
                        <Input type="password" id="old_password" class="mt-1 block w-full" name="old_password"
                            autocomplete="old_password" placeholder="Old Password" />
                        <InputError class="mt-2" :message="errors.old_password" />
                    </div>
                    <div class="col-span-4 w-full">
                        <Label for="name">
                            New Password
                        </Label>
                        <Input type="password" id="new_password" class="mt-1 block w-full" name="new_password"
                            autocomplete="new_password" placeholder="New Password" />
                        <InputError class="mt-2" :message="errors.new_password" />
                    </div>
                    <div class="col-span-4 w-full">
                        <Label for="name">
                            New Password Confirmation
                        </Label>
                        <Input type="password" id="new_password_confirmation" class="mt-1 block w-full"
                            name="new_password_confirmation" autocomplete="new_password_confirmation"
                            placeholder="New Password Confirmation" />
                        <InputError class="mt-2" :message="errors.new_password_confirmation" />
                    </div>
                </div>

                <div class="flex justify-end items-center gap-4">
                    <div class="flex gap-2">
                        <Button
                            type="button"
                            variant="destructive"
                            style="cursor: pointer;"
                            @click="$inertia.visit('/user')"
                        >
                            Cancel
                        </Button>
                        <Button
                            :disabled="processing"
                            style="cursor: pointer;"
                        >
                            Save
                        </Button>
                    </div>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p
                            v-show="recentlySuccessful"
                            class="text-sm text-neutral-600"
                        >
                            Saved.
                        </p>
                    </Transition>
                </div>
            </Form>
        </div>
    </AppLayout>
</template>
