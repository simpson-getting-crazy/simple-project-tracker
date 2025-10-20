<script setup>

import UserController from '@/actions/App/Http/Controllers/UserController';
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head, Link, usePage } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import Button from '@/components/ui/button/Button.vue';

const breadcrumbItems = [
    {
        title: 'User Settings',
        href: '/user',
    },
    {
        title: 'Create User',
    }
];

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <div class="px-4 py-6">
            <Heading title="Create User Setting" description="Create users and account settings" />

            <Form v-bind="UserController.store.form()" class="space-y-6"
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
                            placeholder="Full name" required />
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
                            placeholder="Email address" required />
                        <InputError class="mt-2" :message="errors.email" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <Label for="name">
                            Password
                            <sup class="text-rose-600">
                                *
                            </sup>
                        </Label>
                        <Input type="password" id="password" class="mt-1 block w-full" name="password"
                            autocomplete="password" placeholder="Password" required />
                        <InputError class="mt-2" :message="errors.password" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <Label for="name">
                            Password Confirmation
                            <sup class="text-rose-600">
                                *
                            </sup>
                        </Label>
                        <Input type="password" id="password_confirmation" class="mt-1 block w-full"
                            name="password_confirmation" autocomplete="password_confirmation"
                            placeholder="Password Confirmation" required />
                        <InputError class="mt-2" :message="errors.password_confirmation" />
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
