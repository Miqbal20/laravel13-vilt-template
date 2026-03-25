<template>
    <div class="flex flex-col min-h-screen">
        <!-- NAVBAR -->
        <nav
            class="fixed top-0 left-0 right-0 h-16 bg-white border-b-[1.5px] border-slate-200 flex items-center justify-between pr-6 z-[100] shadow-[0_1px_6px_rgba(0,0,0,0.05)]">
            <!-- Brand -->
            <div class="flex items-center gap-2.5 w-[240px] pl-6 border-r-[1.5px] border-slate-200 h-full">
                <div class="w-[34px] h-[34px] bg-blue-600 rounded-[9px] flex items-center justify-center">
                    <svg class="w-[18px] h-[18px] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.2">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                </div>
                <span class="font-sora font-bold text-[18px] text-[#0f2044] tracking-tight">Admin</span>
            </div>

            <!-- Right actions -->
            <div class="flex items-center gap-4">
                <!-- Notification -->
                <div class="relative" ref="notificationRef">
                    <button @click="notificationOpen = !notificationOpen"
                        :class="['relative w-9 h-9 rounded-lg border-[1.5px] border-slate-200 flex items-center justify-center transition', notificationOpen ? 'bg-slate-100 text-slate-900 border-slate-300' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900 hover:border-slate-300']">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        <span
                            class="absolute top-1.5 right-1.5 w-[7px] h-[7px] rounded-full bg-red-500 border-[1.5px] border-white"></span>
                    </button>
                    <!-- Notification Dropdown -->
                    <Transition enter-active-class="transition duration-150 ease-out"
                        enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition duration-100 ease-in"
                        leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-2">
                        <div v-if="notificationOpen"
                            class="absolute top-[calc(100%+6px)] right-0 w-80 bg-white border-[1.5px] border-slate-200 rounded-[14px] shadow-[0_12px_40px_rgba(0,0,0,0.12)] z-[200] overflow-hidden">
                            <div
                                class="px-4 py-3 border-b-[1.5px] border-slate-200 flex justify-between items-center bg-slate-50">
                                <span class="text-[13.5px] font-semibold text-slate-900 font-sora">Notifications</span>
                                <span class="text-[11px] font-medium text-blue-600 cursor-pointer hover:underline">Mark
                                    all read</span>
                            </div>
                            <div class="max-h-[300px] overflow-y-auto">
                                <div
                                    class="p-4 border-b border-slate-100 flex gap-3 hover:bg-slate-50 transition cursor-pointer">
                                    <div
                                        class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M20 6L9 17l-5-5" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-medium text-slate-900">System Update Complete</div>
                                        <div class="text-[12px] text-slate-500 mt-0.5 leading-snug">The v1.2 patch has
                                            been applied successfully.</div>
                                        <div class="text-[11px] text-slate-400 mt-1.5">2 mins ago</div>
                                    </div>
                                </div>
                                <div class="p-4 flex gap-3 hover:bg-slate-50 transition cursor-pointer">
                                    <div
                                        class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path
                                                d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                                            <line x1="12" y1="9" x2="12" y2="13" />
                                            <line x1="12" y1="17" x2="12.01" y2="17" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-medium text-slate-900">Storage Warning</div>
                                        <div class="text-[12px] text-slate-500 mt-0.5 leading-snug">Server storage is at
                                            85% capacity.</div>
                                        <div class="text-[11px] text-slate-400 mt-1.5">1 hour ago</div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 border-t-[1.5px] border-slate-200 text-center">
                                <span class="text-[12px] font-medium text-blue-600 cursor-pointer hover:underline">View
                                    all notifications</span>
                            </div>
                        </div>
                    </Transition>
                </div>

                <!-- Profile -->
                <div class="relative" ref="profileRef">
                    <button @click="profileOpen = !profileOpen"
                        :class="['flex items-center gap-2.5 py-[5px] pl-[5px] pr-2.5 border-[1.5px] border-slate-200 rounded-full transition cursor-pointer', profileOpen ? 'bg-slate-100 border-slate-300' : 'hover:bg-slate-100 hover:border-slate-300']">
                        <div class="w-8 h-8 rounded-full bg-[#1e3a7b] flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-[13px] font-semibold font-sora">{{ initials }}</span>
                        </div>
                        <span class="text-[13px] font-medium text-slate-900 whitespace-nowrap">{{
                            $page.props.auth.user?.name }}</span>
                        <svg class="text-slate-500 transition-transform duration-200"
                            :class="profileOpen ? 'rotate-180' : ''" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <Transition enter-active-class="transition duration-150 ease-out"
                        enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition duration-100 ease-in"
                        leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-2">
                        <div v-if="profileOpen"
                            class="absolute top-[calc(100%+6px)] right-0 w-60 bg-white border-[1.5px] border-slate-200 rounded-[14px] shadow-[0_12px_40px_rgba(0,0,0,0.12)] z-[200] overflow-hidden">
                            <!-- Header -->
                            <div class="flex items-center gap-3 p-4 border-b-[1.5px] border-slate-200 bg-slate-50">
                                <div
                                    class="w-[46px] h-[46px] rounded-full bg-[#0f2044] flex items-center justify-center border-2 border-blue-600 flex-shrink-0">
                                    <span class="text-white text-base font-bold font-sora">{{ initials }}</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm text-slate-900 font-sora">{{
                                        $page.props.auth.user?.name }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ $page.props.auth.user?.email }}</div>
                                </div>
                            </div>
                            <div class="h-px bg-slate-200"></div>
                            <!-- Logout -->
                            <button @click="logout"
                                class="flex items-center gap-2.5 w-full px-4 py-[11px] text-[13.5px] text-red-500 text-left transition hover:bg-red-50 cursor-pointer">
                                <svg class="w-[15px] h-[15px] flex-shrink-0" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    <polyline points="16 17 21 12 16 7" />
                                    <line x1="21" y1="12" x2="9" y2="12" />
                                </svg>
                                Sign Out
                            </button>
                        </div>
                    </Transition>
                </div>
            </div>
        </nav>

        <!-- SIDEBAR -->
        <aside
            class="fixed top-16 left-0 w-[240px] h-[calc(100vh-64px)] bg-[#0f2044] px-3 py-5 flex flex-col gap-1 overflow-y-auto z-[90]">
            <span class="text-[10px] font-semibold tracking-[1.2px] uppercase text-white/30 px-3 pb-1 pt-2">Main
                Menu</span>

            <Link :href="route('dashboard')"
                :class="['flex items-center gap-2.5 px-3.5 py-2.5 rounded-[10px] text-[13.5px] font-semibold w-full text-left transition cursor-pointer',
                    $page.url.startsWith('/dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10']">
                <svg class="flex-shrink-0 w-[17px] h-[17px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dashboard
            </Link>

            <Link :href="route('customers.index')"
                :class="['flex items-center gap-2.5 px-3.5 py-2.5 rounded-[10px] text-[13.5px] font-semibold w-full text-left transition cursor-pointer mt-1',
                    $page.url.startsWith('/customers') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10']">
                <svg class="flex-shrink-0 w-[17px] h-[17px]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                CRUD Example
            </Link>
        </aside>

        <!-- MAIN -->
        <main class="ml-[240px] w-[calc(100%-240px)] mt-16 p-8 flex-1 min-h-[calc(100vh-64px)] flex flex-col">
            <div class="w-full flex-1">
                <slot />
            </div>
            
            <footer class="mt-auto pt-8 pb-2 w-full text-center text-sm text-slate-500">
                Laravel 13 Vilt Template - 2026 - Created by <a href="https://github.com/Miqbal20" target="_blank" class="text-blue-600 hover:text-blue-800 transition">Miqbal20</a>
            </footer>
        </main>
    </div>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted, watch } from 'vue';
import { router, usePage, Link } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const profileOpen = ref(false);
const profileRef = ref(null);

const notificationOpen = ref(false);
const notificationRef = ref(null);

const page = usePage();

watch(
    () => page.props.flash,
    (flash) => {
        if (flash?.success) {
            Swal.fire({
                icon: 'success',
                title: flash.success,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        }
        if (flash?.error) {
            Swal.fire({
                icon: 'error',
                title: flash.error,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        }
    },
    { immediate: true, deep: true }
);


const initials = computed(() => {
    const name = page.props.auth.user?.name ?? '';
    return name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2);
});

function logout() {
    profileOpen.value = false;
    Swal.fire({
        title: 'Sign Out',
        text: 'Are you sure you want to sign out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Yes, Sign Out'
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('logout'));
        }
    });
}

function handleClickOutside(e) {
    if (profileRef.value && !profileRef.value.contains(e.target)) {
        profileOpen.value = false;
    }
    if (notificationRef.value && !notificationRef.value.contains(e.target)) {
        notificationOpen.value = false;
    }
}

onMounted(() => document.addEventListener('click', handleClickOutside));
onUnmounted(() => document.removeEventListener('click', handleClickOutside));
</script>
