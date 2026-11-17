<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import {
    ArrowDown,
    ArrowUp,
    ExternalLink,
    House,
    Pencil,
    Plus,
    Trash2,
} from '@lucide/vue';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    destroy,
    edit,
    home,
    index as pagesIndex,
    reorder,
    store,
} from '@/routes/pages';

type PageRow = {
    id: number;
    title: string;
    slug: string;
    url: string;
    is_home: boolean;
    in_menu: boolean;
    published: boolean;
    sections: number;
    updated_at: string | null;
};

const props = defineProps<{ pages: PageRow[] }>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Halaman', href: pagesIndex() }],
    },
});

const creating = ref(false);
const form = useForm({ title: '' });

function create(): void {
    form.post(store.url(), { onSuccess: () => (creating.value = false) });
}

function move(index: number, by: number): void {
    const ids = props.pages.map((p) => p.id);
    const [id] = ids.splice(index, 1);
    ids.splice(index + by, 0, id);
    router.post(reorder.url(), { ids }, { preserveScroll: true });
}

function makeHome(page: PageRow): void {
    router.post(home.url(page.id), {}, { preserveScroll: true });
}

function remove(page: PageRow): void {
    if (
        confirm(
            `Hapus halaman "${page.title}"? Tindakan ini tidak bisa dibatalkan.`,
        )
    ) {
        router.delete(destroy.url(page.id), { preserveScroll: true });
    }
}
</script>

<template>
    <Head title="Halaman" />

    <div class="mx-auto flex w-full max-w-4xl flex-col gap-6 p-4">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold tracking-tight">Halaman</h1>
                <p class="text-sm text-muted-foreground">
                    Atur halaman website dan urutannya di menu.
                </p>
            </div>
            <Button @click="creating = true">
                <Plus class="size-4" />
                Halaman baru
            </Button>
        </div>

        <div class="divide-y rounded-xl border bg-card">
            <div
                v-for="(page, index) in pages"
                :key="page.id"
                class="flex flex-wrap items-center gap-3 p-4"
            >
                <div class="flex flex-col">
                    <Button
                        variant="ghost"
                        size="icon"
                        class="size-6"
                        :disabled="index === 0"
                        aria-label="Naikkan"
                        @click="move(index, -1)"
                    >
                        <ArrowUp class="size-3.5" />
                    </Button>
                    <Button
                        variant="ghost"
                        size="icon"
                        class="size-6"
                        :disabled="index === pages.length - 1"
                        aria-label="Turunkan"
                        @click="move(index, 1)"
                    >
                        <ArrowDown class="size-3.5" />
                    </Button>
                </div>
                <div class="min-w-0 flex-1">
                    <Link
                        :href="edit(page.id)"
                        class="font-medium hover:underline"
                        >{{ page.title }}</Link
                    >
                    <div
                        class="mt-1 flex flex-wrap items-center gap-2 text-xs text-muted-foreground"
                    >
                        <span>{{ page.is_home ? '/' : `/${page.slug}` }}</span>
                        <span>· {{ page.sections }} section</span>
                        <Badge v-if="page.is_home" variant="secondary"
                            >Beranda</Badge
                        >
                        <Badge v-if="!page.published" variant="outline"
                            >Draf</Badge
                        >
                        <Badge v-if="!page.in_menu" variant="outline"
                            >Tidak di menu</Badge
                        >
                    </div>
                </div>
                <div class="flex gap-1">
                    <Button as-child variant="ghost" size="icon" class="size-8">
                        <a
                            :href="page.url"
                            target="_blank"
                            rel="noopener"
                            aria-label="Lihat"
                            ><ExternalLink class="size-4"
                        /></a>
                    </Button>
                    <Button
                        v-if="!page.is_home"
                        variant="ghost"
                        size="icon"
                        class="size-8"
                        aria-label="Jadikan beranda"
                        title="Jadikan beranda"
                        @click="makeHome(page)"
                    >
                        <House class="size-4" />
                    </Button>
                    <Button as-child variant="ghost" size="icon" class="size-8">
                        <Link :href="edit(page.id)" aria-label="Edit"
                            ><Pencil class="size-4"
                        /></Link>
                    </Button>
                    <Button
                        v-if="!page.is_home"
                        variant="ghost"
                        size="icon"
                        class="size-8"
                        aria-label="Hapus"
                        @click="remove(page)"
                    >
                        <Trash2 class="size-4" />
                    </Button>
                </div>
            </div>
        </div>
    </div>

    <Dialog v-model:open="creating">
        <DialogContent>
            <form class="grid gap-4" @submit.prevent="create">
                <DialogHeader>
                    <DialogTitle>Halaman baru</DialogTitle>
                    <DialogDescription>
                        Beri judul, lalu isi section-nya di halaman berikutnya.
                    </DialogDescription>
                </DialogHeader>
                <div class="grid gap-2">
                    <Label for="new-title">Judul halaman</Label>
                    <Input
                        id="new-title"
                        v-model="form.title"
                        required
                        placeholder="Contoh: Layanan, Proyek, Karier"
                    />
                    <InputError :message="form.errors.title" />
                </div>
                <DialogFooter>
                    <Button type="submit" :disabled="form.processing"
                        >Buat halaman</Button
                    >
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
