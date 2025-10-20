<script setup>

import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import Button from '@/components/ui/button/Button.vue';
import { router } from '@inertiajs/vue3';
import { toast } from "vue-sonner"
import { PlusCircle } from 'lucide-vue-next';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table"

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog'

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
                        <TableHead>
                            Name
                        </TableHead>
                        <TableHead>
                            Email address
                        </TableHead>
                        <TableHead class="text-right">
                            Role
                        </TableHead>
                        <TableHead>
                            Actions
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="user, key in users" :key="user.id">
                        <TableCell class="font-medium">
                            {{ key + 1 }}
                        </TableCell>
                        <TableCell>
                            {{ user.name }}
                        </TableCell>
                        <TableCell>
                            {{ user.email }}
                        </TableCell>
                        <TableCell class="text-right">
                            {{ user.role }}
                        </TableCell>
                        <TableCell>
                            <div class="flex gap-2">
                                <Button style="cursor: pointer;" @click="$inertia.visit(`/user/${user.id}`)">
                                    Edit
                                </Button>
                                <AlertDialog>
                                    <AlertDialogTrigger as-child>
                                        <Button variant="destructive">Delete</Button>
                                    </AlertDialogTrigger>
                                    <AlertDialogContent>
                                        <AlertDialogHeader>
                                            <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                This action cannot be undone. This will permanently delete your
                                                account and remove your data from our servers.
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                                            <AlertDialogAction @click="deleteRecord(user.id)">Confirm Deletion
                                            </AlertDialogAction>
                                        </AlertDialogFooter>
                                    </AlertDialogContent>
                                </AlertDialog>
                            </div>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
