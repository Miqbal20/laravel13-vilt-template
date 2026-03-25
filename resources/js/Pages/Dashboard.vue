<template>
    <Head title="Dashboard" />

    <AppLayout>
        <!-- Sidebar nav items -->
        <template #sidebar>
            <button
                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-[10px] text-white text-[13.5px] font-semibold bg-blue-600 w-full text-left transition cursor-pointer"
            >
                <svg class="flex-shrink-0 w-[17px] h-[17px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dashboard
            </button>
        </template>

        <!-- Page header -->
        <div class="mb-7">
            <h2 class="font-sora text-2xl font-bold text-[#0f2044] tracking-tight">Dashboard</h2>
            <p class="text-sm text-slate-500 mt-1">Overview of your workspace activity.</p>
        </div>

        <!-- Welcome banner -->
        <div class="relative bg-gradient-to-br from-[#0f2044] to-[#1e3a7b] rounded-2xl p-9 flex items-center justify-between mb-7 overflow-hidden">
            <div
                class="absolute w-[250px] h-[250px] rounded-full pointer-events-none"
                style="background:rgba(56,189,248,.15); top:-80px; right:100px"
            ></div>
            <div
                class="absolute w-[180px] h-[180px] rounded-full pointer-events-none"
                style="background:rgba(37,99,235,.2); bottom:-60px; right:-40px"
            ></div>
            <div class="relative z-10">
                <h3 class="font-sora text-[22px] font-bold text-white tracking-tight mb-2">
                    Welcome back, {{ $page.props.auth.user?.name }}! 👋
                </h3>
                <p class="text-white/65 text-sm leading-relaxed max-w-[420px]">
                    This is your AdminKit dashboard. All components are modular and ready to use.
                </p>
            </div>
            <div class="relative z-10 flex-shrink-0 bg-white/10 backdrop-blur-sm border border-white/15 rounded-xl px-6 py-4 text-center">
                <div class="font-sora text-[32px] font-bold text-sky-400">v1.0</div>
                <div class="text-[11px] text-white/55 mt-0.5 tracking-wide">Template</div>
            </div>
        </div>

        <!-- Stat cards -->
        <div class="grid grid-cols-3 gap-4 mb-7">
            <div
                v-for="stat in stats"
                :key="stat.label"
                class="bg-white rounded-[14px] p-6 border-[1.5px] border-slate-200 flex items-start gap-4 transition hover:shadow-[0_6px_24px_rgba(0,0,0,0.08)] hover:-translate-y-0.5"
            >
                <div :class="['w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0', stat.iconBg]" v-html="stat.icon"></div>
                <div>
                    <div class="text-[12.5px] text-slate-500 font-medium">{{ stat.label }}</div>
                    <div class="font-sora text-[26px] font-bold text-[#0f2044] leading-none my-0.5">{{ stat.value }}</div>
                    <div class="text-xs text-green-500 font-medium">{{ stat.change }}</div>
                </div>
            </div>
        </div>

        <!-- Info cards -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Recent Activity -->
            <div class="bg-white rounded-[14px] p-6 border-[1.5px] border-slate-200">
                <h4 class="font-sora text-[15px] font-semibold text-[#0f2044] mb-3.5 flex items-center gap-2">
                    <svg class="text-blue-600 w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />
                    </svg>
                    Recent Activity
                </h4>
                <div v-for="item in activity" :key="item.text" class="flex items-center gap-3 py-2.5 border-b border-slate-200 last:border-b-0">
                    <span :class="['w-2 h-2 rounded-full flex-shrink-0', item.color]"></span>
                    <span class="text-[13px] text-slate-900 flex-1">{{ item.text }}</span>
                    <span class="text-[11.5px] text-slate-500">{{ item.time }}</span>
                </div>
            </div>

            <!-- Template notice -->
            <div class="bg-white rounded-[14px] p-6 border-[1.5px] border-slate-200">
                <h4 class="font-sora text-[15px] font-semibold text-[#0f2044] mb-3.5 flex items-center gap-2">
                    <svg class="text-blue-600 w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                    Template Notes
                </h4>
                <div class="bg-blue-50 border-[1.5px] border-blue-200 rounded-[10px] px-4 py-3 text-[13.5px] text-blue-700 flex items-start gap-2.5 mb-2.5">
                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    This is a template — replace content with your real data.
                </div>
                <p class="text-[13px] text-slate-500 leading-relaxed">
                    Add more pages and sidebar items as you build out your application.
                </p>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const stats = [
    {
        label: 'Total Users',
        value: '2,847',
        change: '↑ 12.5% this month',
        iconBg: 'bg-blue-100 text-blue-600',
        icon: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>`,
    },
    {
        label: 'Revenue',
        value: '$48.2k',
        change: '↑ 8.1% this month',
        iconBg: 'bg-green-100 text-green-700',
        icon: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>`,
    },
    {
        label: 'Active Sessions',
        value: '389',
        change: '↑ 3.2% today',
        iconBg: 'bg-violet-100 text-violet-700',
        icon: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>`,
    },
];

const activity = [
    { color: 'bg-blue-600', text: 'New user registered', time: '2m ago' },
    { color: 'bg-green-500', text: 'Report exported successfully', time: '14m ago' },
    { color: 'bg-orange-500', text: 'System backup completed', time: '1h ago' },
    { color: 'bg-blue-600', text: 'Settings updated by admin', time: '3h ago' },
];
</script>
