<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Inbox, Mail, Phone, Trash2 } from '@lucide/vue';
import { ref } from 'vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { destroy, index as messagesIndex, read } from '@/routes/messages';

type Message = {
    id: number;
    name: string;
    email: string;
    phone: string | null;
    body: string;
    read: boolean;
    created_at: string;
};

defineProps<{
    messages: {
        data: Message[];
        links: { url: string | null; label: string; active: boolean }[];
        last_page: number;
    };
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Pesan Masuk', href: messagesIndex() }],
    },
});

const openId = ref<number | null>(null);

function pageLabel(label: string): string {
    return label
        .replace('&laquo; Previous', '‹')
        .replace('Next &raquo;', '›')
        .replace(/&[a-z]+;/g, '');
}

function toggle(message: Message): void {
    openId.value = openId.value === message.id ? null : message.id;

    if (!message.read) {
        router.post(
            read.url(message.id),
            {},
            { preserveScroll: true, preserveState: true },
        );
    }
}

function remove(message: Message): void {
    if (confirm(`Hapus pesan dari ${message.name}?`)) {
        router.delete(destroy.url(message.id), { preserveScroll: true });
    }
}
</script>

<template>
    <Head title="Pesan Masuk" />

    <div class="mx-auto flex w-full max-w-4xl flex-col gap-6 p-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">Pesan Masuk</h1>
            <p class="text-sm text-muted-foreground">
                Pesan yang dikirim pengunjung lewat form kontak.
            </p>
        </div>

        <div
            v-if="messages.data.length === 0"
            class="flex flex-col items-center gap-2 rounded-xl border border-dashed p-12 text-center text-muted-foreground"
        >
            <Inbox class="size-8" />
            <p>Belum ada pesan.</p>
        </div>

        <div v-else class="divide-y rounded-xl border bg-card">
            <div v-for="message in messages.data" :key="message.id">
                <button
                    type="button"
                    class="flex w-full items-start gap-3 p-4 text-left hover:bg-muted/40"
                    @click="toggle(message)"
                >
                    <span
                        class="mt-1.5 size-2 shrink-0 rounded-full"
                        :class="message.read ? 'bg-transparent' : 'bg-primary'"
                    />
                    <span class="min-w-0 flex-1">
                        <span class="flex flex-wrap items-center gap-2">
                            <span
                                :class="message.read ? '' : 'font-semibold'"
                                >{{ message.name }}</span
                            >
                            <Badge v-if="!message.read" variant="secondary"
                                >Baru</Badge
                            >
                        </span>
                        <span
                            class="block truncate text-sm text-muted-foreground"
                            >{{ message.body }}</span
                        >
                    </span>
                    <span class="shrink-0 text-xs text-muted-foreground">{{
                        message.created_at
                    }}</span>
                </button>
                <div v-if="openId === message.id" class="grid gap-4 px-9 pb-5">
                    <p class="text-sm whitespace-pre-line">
                        {{ message.body }}
                    </p>
                    <div class="flex flex-wrap items-center gap-2">
                        <Button as-child size="sm">
                            <a :href="`mailto:${message.email}`"
                                ><Mail class="size-4" /> Balas email</a
                            >
                        </Button>
                        <Button
                            v-if="message.phone"
                            as-child
                            size="sm"
                            variant="outline"
                        >
                            <a :href="`tel:${message.phone}`"
                                ><Phone class="size-4" /> {{ message.phone }}</a
                            >
                        </Button>
                        <span class="text-sm text-muted-foreground">{{
                            message.email
                        }}</span>
                        <Button
                            size="sm"
                            variant="ghost"
                            class="ml-auto"
                            @click="remove(message)"
                        >
                            <Trash2 class="size-4" /> Hapus
                        </Button>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="messages.last_page > 1" class="flex flex-wrap gap-1">
            <template v-for="link in messages.links" :key="link.label">
                <Button
                    v-if="link.url"
                    as-child
                    size="sm"
                    :variant="link.active ? 'default' : 'outline'"
                >
                    <Link :href="link.url" preserve-scroll>{{
                        pageLabel(link.label)
                    }}</Link>
                </Button>
            </template>
        </div>
    </div>
</template>
