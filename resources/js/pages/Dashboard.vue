<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { CircleCheck, Circle, ExternalLink, Settings2 } from '@lucide/vue';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { dashboard } from '@/routes';
import { edit as editSite } from '@/routes/site';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Dashboard', href: dashboard() }],
    },
});

const props = defineProps<{
    siteName: string;
    siteUrl: string;
    checklist: { label: string; done: boolean }[];
}>();

const doneCount = computed(
    () => props.checklist.filter((item) => item.done).length,
);
</script>

<template>
    <Head title="Dashboard" />

    <div class="mx-auto flex w-full max-w-4xl flex-col gap-6 p-4">
        <div
            class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <h1 class="text-xl font-semibold tracking-tight">
                    Selamat datang di admin {{ siteName }}
                </h1>
                <p class="text-sm text-muted-foreground">
                    Atur tampilan dan isi website perusahaan Anda dari sini.
                </p>
            </div>
            <Button as-child variant="outline">
                <a :href="siteUrl" target="_blank" rel="noopener">
                    <ExternalLink class="size-4" />
                    Lihat website
                </a>
            </Button>
        </div>

        <Card>
            <CardHeader>
                <CardTitle>Lengkapi website Anda</CardTitle>
                <CardDescription>
                    {{ doneCount }} dari {{ checklist.length }} langkah selesai
                </CardDescription>
            </CardHeader>
            <CardContent class="grid gap-4">
                <div class="h-2 overflow-hidden rounded-full bg-muted">
                    <div
                        class="h-full rounded-full bg-primary transition-all"
                        :style="{
                            width: `${(doneCount / checklist.length) * 100}%`,
                        }"
                    />
                </div>
                <ul class="grid gap-2">
                    <li
                        v-for="item in checklist"
                        :key="item.label"
                        class="flex items-center gap-2 text-sm"
                        :class="item.done ? 'text-muted-foreground' : ''"
                    >
                        <CircleCheck
                            v-if="item.done"
                            class="size-4 text-green-600"
                        />
                        <Circle v-else class="size-4 text-muted-foreground" />
                        <span :class="item.done ? 'line-through' : ''">{{
                            item.label
                        }}</span>
                    </li>
                </ul>
                <div>
                    <Button as-child>
                        <Link :href="editSite()">
                            <Settings2 class="size-4" />
                            Buka Pengaturan Situs
                        </Link>
                    </Button>
                </div>
            </CardContent>
        </Card>
    </div>
</template>
