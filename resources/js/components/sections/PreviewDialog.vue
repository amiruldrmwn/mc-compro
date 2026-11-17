<script setup lang="ts">
import { ref, watch } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Spinner } from '@/components/ui/spinner';
import { post } from '@/lib/http';
import { preview } from '@/routes/pages';
import type { Section } from '@/types/sections';

const props = defineProps<{
    pageId: number;
    sections: Section[] | null;
    title: string;
}>();

const open = defineModel<boolean>('open', { required: true });

const html = ref('');
const loading = ref(false);
const error = ref('');

watch(open, async (isOpen) => {
    if (!isOpen || !props.sections) {
        return;
    }

    loading.value = true;
    error.value = '';
    html.value = '';

    try {
        const response = await post(
            preview.url(props.pageId),
            { sections: props.sections },
            'html',
        );
        html.value = await response.text();
    } catch (e) {
        error.value = (e as Error).message;
    } finally {
        loading.value = false;
    }
});
</script>

<template>
    <Dialog v-model:open="open">
        <DialogContent
            class="flex h-[90vh] max-w-[95vw] flex-col gap-3 p-4 sm:max-w-6xl"
        >
            <DialogHeader>
                <DialogTitle>{{ title }}</DialogTitle>
            </DialogHeader>
            <div
                class="relative flex-1 overflow-hidden rounded-md border bg-white"
            >
                <div
                    v-if="loading"
                    class="absolute inset-0 flex items-center justify-center"
                >
                    <Spinner />
                </div>
                <p v-else-if="error" class="p-6 text-sm text-destructive">
                    {{ error }}
                </p>
                <iframe
                    v-else
                    :srcdoc="html"
                    title="Pratinjau halaman"
                    sandbox="allow-same-origin"
                    class="size-full"
                />
            </div>
        </DialogContent>
    </Dialog>
</template>
