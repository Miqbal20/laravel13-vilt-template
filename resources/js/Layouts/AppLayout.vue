<template>
    <div class="flex flex-col min-h-screen">
        <!-- NAVBAR -->
        <nav class="fixed top-0 left-0 right-0 h-16 bg-white border-b-[1.5px] border-slate-200 flex items-center justify-between pr-6 z-[100] shadow-[0_1px_6px_rgba(0,0,0,0.05)]">
            <!-- Brand -->
            <div class="flex items-center gap-2.5 w-[240px] pl-6 border-r-[1.5px] border-slate-200 h-full">
                <div class="w-[34px] h-[34px] bg-blue-600 rounded-[9px] flex items-center justify-center">
                    <svg class="w-[18px] h-[18px] text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                </div>
                <span class="font-sora font-bold text-[18px] text-[#0f2044] tracking-tight">AdminKit</span>
            </div>

            <!-- Right actions -->
            <div class="flex items-center gap-4">
                <!-- Notification -->
                <button class="relative w-9 h-9 rounded-lg border-[1.5px] border-slate-200 flex items-center justify-center text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-[7px] h-[7px] rounded-full bg-red-500 border-[1.5px] border-white"></span>
                </button>

                <!-- Profile -->
                <div class="relative" ref="profileRef">
                    <button
                        @click="profileOpen = !profileOpen"
                        :class="['flex items-center gap-2.5 py-[5px] pl-[5px] pr-2.5 border-[1.5px] border-slate-200 rounded-full transition cursor-pointer', profileOpen ? 'bg-slate-100 border-slate-300' : 'hover:bg-slate-100 hover:border-slate-300']"
                    >
                        <div class="w-8 h-8 rounded-full bg-[#1e3a7b] flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-[13px] font-semibold font-sora">{{ initials }}</span>
                        </div>
                        <span class="text-[13px] font-medium text-slate-900 whitespace-nowrap">{{ $page.props.auth.user?.name }}</span>
                        <svg
                            class="text-slate-500 transition-transform duration-200"
                            :class="profileOpen ? 'rotate-180' : ''"
                            width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        >
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <Transition
                        enter-active-class="transition duration-150 ease-out"
                        enter-from-class="opacity-0 -translate-y-2"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition duration-100 ease-in"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 -translate-y-2"
                    >
                        <div v-if="profileOpen" class="absolute top-[calc(100%+6px)] right-0 w-60 bg-white border-[1.5px] border-slate-200 rounded-[14px] shadow-[0_12px_40px_rgba(0,0,0,0.12)] z-[200] overflow-hidden">
                            <!-- Header -->
                            <div class="flex items-center gap-3 p-4 border-b-[1.5px] border-slate-200 bg-slate-50">
                                <div class="w-[46px] h-[46px] rounded-full bg-[#0f2044] flex items-center justify-center border-2 border-blue-600 flex-shrink-0">
                                    <span class="text-white text-base font-bold font-sora">{{ initials }}</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm text-slate-900 font-sora">{{ $page.props.auth.user?.name }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ $page.props.auth.user?.email }}</div>
                                </div>
                            </div>
                            <div class="h-px bg-slate-200"></div>
                            <!-- Logout -->
                            <button
                                @click="logout"
                                class="flex items-center gap-2.5 w-full px-4 py-[11px] text-[13.5px] text-red-500 text-left transition hover:bg-red-50 cursor-pointer"
                            >
                                <svg class="w-[15px] h-[15px] flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
        <aside class="fixed top-16 left-0 w-[240px] h-[calc(100vh-64px)] bg-[#0f2044] px-3 py-5 flex flex-col gap-1 overflow-y-auto z-[90]">
            <span class="text-[10px] font-semibold tracking-[1.2px] uppercase text-white/30 px-3 pb-1 pt-2">Main Menu</span>
            <slot name="sidebar" />
        </aside>

        <!-- MAIN -->
        <main class="ml-[240px] mt-16 p-8 flex-1 min-h-[calc(100vh-64px)]">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const profileOpen = ref(false);
const profileRef = ref(null);

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
}

onMounted(() => document.addEventListener('click', handleClickOutside));
onUnmounted(() => document.removeEventListener('click', handleClickOutside));
</script>
