<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { Check, ExternalLink, Eye } from '@lucide/vue';
import { ref } from 'vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { index as themesIndex, update } from '@/routes/themes';

type Theme = {
    key: string;
    label: string;
    description: string;
    color: string;
    sample_url: string;
    preview_url: string;
};

defineProps<{ themes: Theme[]; current: string }>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Template', href: themesIndex() }],
    },
});

const choosing = ref<Theme | null>(null);
const dialogOpen = ref(false);
const busy = ref(false);

function choose(theme: Theme): void {
    choosing.value = theme;
    dialogOpen.value = true;
}

function apply(withContent: boolean): void {
    if (!choosing.value) {
        return;
    }

    router.put(
        update.url(),
        { theme: choosing.value.key, with_content: withContent },
        {
            preserveScroll: true,
            onStart: () => (busy.value = true),
            onFinish: () => {
                busy.value = false;
                dialogOpen.value = false;
            },
        },
    );
}
</script>

<template>
    <Head title="Template" />

    <div class="mx-auto flex w-full max-w-6xl flex-col gap-6 p-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">Template</h1>
            <p class="text-sm text-muted-foreground">
                Pilih tampilan website. Gambar kecil menunjukkan contoh isi
                untuk tiap template. Saat mengganti template, Anda bisa
                mempertahankan isi website atau memakai isi contohnya.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <div
                v-for="theme in themes"
                :key="theme.key"
                class="flex flex-col overflow-hidden rounded-xl border bg-card"
                :class="{ 'ring-2 ring-primary': theme.key === current }"
            >
                <div class="relative h-56 overflow-hidden border-b bg-muted">
                    <iframe
                        :src="theme.sample_url"
                        :title="`Contoh ${theme.label}`"
                        class="pointer-events-none absolute top-0 left-0 h-[200%] w-[200%] origin-top-left scale-50"
                        loading="lazy"
                        tabindex="-1"
                    />
                </div>
                <div class="flex flex-1 flex-col gap-3 p-4">
                    <div class="flex items-center gap-2">
                        <span
                            class="size-3 rounded-full"
                            :style="{ background: theme.color }"
                        />
                        <h2 class="font-semibold">{{ theme.label }}</h2>
                        <Badge v-if="theme.key === current">Dipakai</Badge>
                    </div>
                    <p class="flex-1 text-sm text-muted-foreground">
                        {{ theme.description }}
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <Button
                            v-if="theme.key !== current"
                            size="sm"
                            @click="choose(theme)"
                        >
                            <Check class="size-4" />
                            Pakai template ini
                        </Button>
                        <Button as-child size="sm" variant="outline">
                            <a
                                :href="theme.sample_url"
                                target="_blank"
                                rel="noopener"
                            >
                                <Eye class="size-4" />
                                Contoh
                            </a>
                        </Button>
                        <Button as-child size="sm" variant="ghost">
                            <a
                                :href="theme.preview_url"
                                target="_blank"
                                rel="noopener"
                            >
                                <ExternalLink class="size-4" />
                                Dengan isi Anda
                            </a>
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Dialog v-model:open="dialogOpen">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Pakai template {{ choosing?.label }}?</DialogTitle>
                <DialogDescription>
                    Pilih apa yang terjadi dengan isi website Anda.
                </DialogDescription>
            </DialogHeader>
            <div class="grid gap-3">
                <button
                    type="button"
                    class="rounded-lg border p-4 text-left transition hover:bg-muted/60 disabled:opacity-50"
                    :disabled="busy"
                    @click="apply(false)"
                >
                    <div class="font-medium">Ganti tampilan saja</div>
                    <div class="text-sm text-muted-foreground">
                        Semua halaman dan tulisan Anda tetap, hanya tampilannya
                        yang berubah.
                    </div>
                </button>
                <button
                    type="button"
                    class="rounded-lg border p-4 text-left transition hover:bg-muted/60 disabled:opacity-50"
                    :disabled="busy"
                    @click="apply(true)"
                >
                    <div class="font-medium">Pakai isi contoh template</div>
                    <div class="text-sm text-muted-foreground">
                        Halaman diganti dengan contoh lengkap untuk template ini
                        (foto, menu, harga) dan warna utama ikut disesuaikan.
                        <strong class="text-destructive"
                            >Halaman lama akan dihapus.</strong
                        >
                    </div>
                </button>
            </div>
        </DialogContent>
    </Dialog>
</template>
