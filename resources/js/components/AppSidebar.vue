<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    ExternalLink,
    FileText,
    Inbox,
    LayoutGrid,
    Palette,
    Settings2,
} from '@lucide/vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, home } from '@/routes';
import { index as messagesIndex } from '@/routes/messages';
import { index as pagesIndex } from '@/routes/pages';
import { edit as editSite } from '@/routes/site';
import { index as themesIndex } from '@/routes/themes';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Halaman',
        href: pagesIndex(),
        icon: FileText,
    },
    {
        title: 'Template',
        href: themesIndex(),
        icon: Palette,
    },
    {
        title: 'Pesan Masuk',
        href: messagesIndex(),
        icon: Inbox,
    },
    {
        title: 'Pengaturan Situs',
        href: editSite(),
        icon: Settings2,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Lihat Website',
        href: home.url(),
        icon: ExternalLink,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
