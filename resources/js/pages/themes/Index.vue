<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { Check, ExternalLink } from '@lucide/vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { index as themesIndex, update } from '@/routes/themes';

type Theme = {
    key: string;
    label: string;
    description: string;
    preview_url: string;
};

defineProps<{ themes: Theme[]; current: string }>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Template', href: themesIndex() }],
    },
});

function use(key: string): void {
    router.put(update.url(), { theme: key }, { preserveScroll: true });
}
</script>

<template>
    <Head title="Template" />

    <div class="mx-auto flex w-full max-w-6xl flex-col gap-6 p-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">Template</h1>
            <p class="text-sm text-muted-foreground">
                Pilih tampilan website. Isi halaman tetap sama saat template
                diganti.
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
                        :src="theme.preview_url"
                        :title="`Pratinjau ${theme.label}`"
                        class="pointer-events-none absolute top-0 left-0 h-[200%] w-[200%] origin-top-left scale-50"
                        loading="lazy"
                        tabindex="-1"
                    />
                </div>
                <div class="flex flex-1 flex-col gap-3 p-4">
                    <div class="flex items-center gap-2">
                        <h2 class="font-semibold">{{ theme.label }}</h2>
                        <Badge v-if="theme.key === current">Dipakai</Badge>
                    </div>
                    <p class="flex-1 text-sm text-muted-foreground">
                        {{ theme.description }}
                    </p>
                    <div class="flex gap-2">
                        <Button
                            v-if="theme.key !== current"
                            size="sm"
                            @click="use(theme.key)"
                        >
                            <Check class="size-4" />
                            Pakai template ini
                        </Button>
                        <Button as-child size="sm" variant="outline">
                            <a
                                :href="theme.preview_url"
                                target="_blank"
                                rel="noopener"
                            >
                                <ExternalLink class="size-4" />
                                Pratinjau
                            </a>
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
