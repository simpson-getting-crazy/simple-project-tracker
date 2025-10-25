<script setup>

import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { router } from '@inertiajs/vue3';
import { toast } from "vue-sonner"
import { PlusCircle } from 'lucide-vue-next';
import DeleteConfirmation from '@/components/DeleteConfirmation.vue';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table"

import { User } from "lucide-vue-next"
import {
    Empty,
    EmptyContent,
    EmptyDescription,
    EmptyHeader,
    EmptyMedia,
    EmptyTitle,
} from "@/components/ui/empty"

const props = defineProps({
    users: Object,
});

const breadcrumbItems = [
    {
        title: 'User Settings',
        href: '/user',
    },
];

const deleteRecord = (id) => {
    router.delete(`/user/${id}/destroy`, {
        preserveScroll: true,
    });

    toast("User has been deleted", {
        description: "The user has been deleted successfully.",
    });
};

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <div class="px-4 py-6">
            <div class="flex items-center justify-between">
                <Heading title="User Setting" description="Manage users and account settings" />
                <Button style="cursor: pointer;" @click="$inertia.visit('/user/create')">
                    <PlusCircle />
                    Create User
                </Button>
            </div>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">
                            #
                        </TableHead>
                        <TableHead class="text-center">
                            Name
                        </TableHead>
                        <TableHead class="text-center">
                            Email address
                        </TableHead>
                        <TableHead class="text-center">
                            Role
                        </TableHead>
                        <TableHead class="text-center">
                            Actions
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="user, key in users" :key="user.id" v-if="Object.keys(users).length > 0">
                        <TableCell class="font-medium">
                            {{ key + 1 }}
                        </TableCell>
                        <TableCell class="text-center">
                            {{ user.name }}
                        </TableCell>
                        <TableCell class="text-center">
                            {{ user.email }}
                        </TableCell>
                        <TableCell class="text-center">
                            {{ user.role }}
                        </TableCell>
                        <TableCell>
                            <div class="flex gap-2 justify-center">
                                <Button style="cursor: pointer;" @click="$inertia.visit(`/user/${user.id}/edit`)">
                                    Edit
                                </Button>
                                <DeleteConfirmation
                                    :text="`Are you sure you want to delete ${user.name}? This action cannot be undone.`"
                                    :actions="() => deleteRecord(user.id)" />
                            </div>
                        </TableCell>
                    </TableRow>
                    <TableRow v-else>
                        <TableCell colspan="5">
                            <Empty class="border border-dashed">
                                <EmptyHeader>
                                    <EmptyMedia variant="icon">
                                        <User />
                                    </EmptyMedia>
                                    <EmptyTitle>Users Data is Empty</EmptyTitle>
                                    <EmptyDescription>
                                        Get started by creating a new user.
                                    </EmptyDescription>
                                </EmptyHeader>
                                <EmptyContent>
                                    <Button
                                        variant="outline"
                                        size="sm"
                                        style="cursor: pointer;"
                                        @click="$inertia.visit('/user/create')"
                                    >
                                        Create User
                                    </Button>
                                </EmptyContent>
                            </Empty>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
