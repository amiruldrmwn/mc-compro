<script setup lang="ts">
import { ArrowDown, ArrowUp, Plus, Trash2 } from '@lucide/vue';
import { computed } from 'vue';
import ImageField from '@/components/sections/ImageField.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import type { FieldDef, SectionData, SectionValue } from '@/types/sections';

const props = defineProps<{
    field: FieldDef;
    name: string;
    storageUrl: string;
    error?: string;
}>();

const value = defineModel<SectionValue>();

const text = computed({
    get: () => (typeof value.value === 'string' ? value.value : ''),
    set: (v: string | number) => (value.value = String(v)),
});

const items = computed<SectionData[]>(() =>
    Array.isArray(value.value) ? (value.value as SectionData[]) : [],
);

function blankItem(): SectionData {
    return Object.fromEntries(
        Object.entries(props.field.fields ?? {}).map(([key, f]) => [
            key,
            f.type === 'items' ? [] : (f.default ?? ''),
        ]),
    );
}

function addItem(): void {
    value.value = [...items.value, blankItem()];
}

function removeItem(index: number): void {
    value.value = items.value.filter((_, i) => i !== index);
}

function moveItem(index: number, by: number): void {
    const list = [...items.value];
    const [item] = list.splice(index, 1);
    list.splice(index + by, 0, item);
    value.value = list;
}

function setItemField(
    index: number,
    key: string,
    v: SectionValue | undefined,
): void {
    value.value = items.value.map((item, i) =>
        i === index ? { ...item, [key]: v ?? '' } : item,
    );
}

const itemTitle = (item: SectionData, index: number): string => {
    const first = Object.values(item).find(
        (v) => typeof v === 'string' && v !== '' && !v.includes('/'),
    );

    return (first as string | undefined) ?? `Item ${index + 1}`;
};
</script>

<template>
    <div class="grid gap-2">
        <Label :for="name">
            {{ field.label }}
            <span v-if="field.required" class="text-destructive">*</span>
        </Label>

        <Input
            v-if="field.type === 'text' || field.type === 'url'"
            :id="name"
            v-model="text"
            :maxlength="field.max"
            :placeholder="field.type === 'url' ? 'Contoh: /kontak' : ''"
        />

        <template
            v-else-if="field.type === 'textarea' || field.type === 'markdown'"
        >
            <Textarea
                :id="name"
                v-model="text"
                :maxlength="field.max"
                :rows="field.type === 'markdown' ? 6 : 3"
            />
            <p
                v-if="field.type === 'markdown'"
                class="text-xs text-muted-foreground"
            >
                Pisahkan paragraf dengan baris kosong. **tebal**, *miring*, dan
                daftar dengan tanda "-" didukung.
            </p>
        </template>

        <select
            v-else-if="field.type === 'select'"
            :id="name"
            v-model="text"
            class="h-9 w-full rounded-md border border-input bg-transparent px-3 text-sm shadow-xs dark:bg-input/30"
        >
            <option
                v-for="(label, key) in field.options"
                :key="key"
                :value="key"
            >
                {{ label }}
            </option>
        </select>

        <ImageField
            v-else-if="field.type === 'image'"
            v-model="text"
            :storage-url="storageUrl"
        />

        <div v-else-if="field.type === 'items'" class="grid gap-3">
            <div
                v-for="(item, index) in items"
                :key="index"
                class="rounded-lg border bg-muted/30 p-3"
            >
                <div class="mb-3 flex items-center justify-between gap-2">
                    <span class="truncate text-sm font-medium">
                        {{ itemTitle(item, index) }}
                    </span>
                    <div class="flex shrink-0 gap-1">
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            class="size-7"
                            :disabled="index === 0"
                            aria-label="Naikkan"
                            @click="moveItem(index, -1)"
                        >
                            <ArrowUp class="size-4" />
                        </Button>
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            class="size-7"
                            :disabled="index === items.length - 1"
                            aria-label="Turunkan"
                            @click="moveItem(index, 1)"
                        >
                            <ArrowDown class="size-4" />
                        </Button>
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            class="size-7"
                            aria-label="Hapus"
                            @click="removeItem(index)"
                        >
                            <Trash2 class="size-4" />
                        </Button>
                    </div>
                </div>
                <div class="grid gap-3">
                    <FieldInput
                        v-for="(sub, key) in field.fields"
                        :key="key"
                        :field="sub"
                        :name="`${name}-${index}-${key}`"
                        :storage-url="storageUrl"
                        :model-value="item[key]"
                        @update:model-value="
                            (v) => setItemField(index, String(key), v)
                        "
                    />
                </div>
            </div>
            <div>
                <Button
                    type="button"
                    variant="outline"
                    size="sm"
                    :disabled="items.length >= (field.max_items ?? 20)"
                    @click="addItem"
                >
                    <Plus class="size-4" />
                    Tambah {{ field.label.toLowerCase() }}
                </Button>
            </div>
        </div>

        <p v-if="error" class="text-sm text-destructive">{{ error }}</p>
    </div>
</template>
