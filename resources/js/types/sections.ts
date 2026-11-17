export type FieldType =
    | 'text'
    | 'textarea'
    | 'markdown'
    | 'url'
    | 'image'
    | 'select'
    | 'items';

export type FieldDef = {
    type: FieldType;
    label: string;
    max?: number;
    required?: boolean;
    options?: Record<string, string>;
    default?: string;
    max_items?: number;
    fields?: Record<string, FieldDef>;
};

export type SectionTypeDef = {
    label: string;
    description: string;
    fields: Record<string, FieldDef>;
};

// Field values are text, or a list of items for an "items" field.
export type SectionValue = string | SectionData[];

export type SectionData = { [key: string]: SectionValue };

export type Section = {
    id: string;
    type: string;
    data: SectionData;
};
