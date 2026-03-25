<template>
    <div class="flex min-h-screen">
        <!-- Left panel -->
        <section
            id="login-left"
            class="w-[45%] bg-[#0f2044] flex flex-col justify-center items-start px-14 py-16 relative overflow-hidden"
        >
            <!-- Decorative blobs -->
            <div
                class="absolute w-[400px] h-[400px] rounded-full pointer-events-none"
                style="background: radial-gradient(circle, rgba(37,99,235,.35) 0%, transparent 70%); top: -80px; right: -100px"
            ></div>
            <div
                class="absolute w-[300px] h-[300px] rounded-full pointer-events-none"
                style="background: radial-gradient(circle, rgba(56,189,248,.2) 0%, transparent 70%); bottom: -60px; left: -60px"
            ></div>

            <!-- Brand -->
            <div class="flex items-center gap-2.5 mb-14 relative z-10">
                <div class="w-[38px] h-[38px] bg-blue-600 rounded-[10px] flex items-center justify-center">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                </div>
                <span class="font-sora font-bold text-[22px] text-white tracking-tight">AdminKit</span>
            </div>

            <!-- Tagline -->
            <div class="relative z-10">
                <h1 class="font-sora text-[38px] font-bold text-white leading-tight tracking-tighter mb-4">
                    Manage with<br /><span class="text-sky-400">Confidence.</span>
                </h1>
                <p class="text-white/55 text-[15px] leading-relaxed max-w-[340px]">
                    A clean, powerful admin dashboard template to help you ship faster and manage smarter.
                </p>
            </div>

            <!-- Dot grid -->
            <div class="absolute bottom-10 right-10 grid grid-cols-6 gap-2 z-10 opacity-20">
                <span v-for="n in 24" :key="n" class="w-1 h-1 rounded-full bg-white block"></span>
            </div>
        </section>

        <!-- Right panel -->
        <section class="flex-1 flex items-center justify-center px-12 py-10 bg-white">
            <div class="w-full max-w-[400px]">
                <h2 class="font-sora text-[28px] font-bold text-[#0f2044] tracking-tight mb-1.5">Welcome back 👋</h2>
                <p class="text-sm text-slate-500 mb-9">Sign in to your account to continue.</p>

                <form @submit.prevent="submit">
                    <!-- Email -->
                    <div class="mb-5">
                        <label class="block text-[13px] font-medium text-slate-900 mb-1.5" for="email">
                            Email address
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            autocomplete="username"
                            placeholder="admin@example.com"
                            class="w-full px-4 py-[11px] border-[1.5px] rounded-[10px] text-sm text-slate-900 bg-slate-50 outline-none transition"
                            :class="form.errors.email ? 'border-red-400 focus:border-red-500' : 'border-slate-200 focus:border-blue-600 focus:shadow-[0_0_0_3px_rgba(37,99,235,0.12)] focus:bg-white'"
                        />
                        <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-500">{{ form.errors.email }}</p>
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label class="block text-[13px] font-medium text-slate-900 mb-1.5" for="password">
                            Password
                        </label>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-[11px] border-[1.5px] rounded-[10px] text-sm text-slate-900 bg-slate-50 outline-none transition"
                            :class="form.errors.password ? 'border-red-400' : 'border-slate-200 focus:border-blue-600 focus:shadow-[0_0_0_3px_rgba(37,99,235,0.12)] focus:bg-white'"
                        />
                        <p v-if="form.errors.password" class="mt-1.5 text-xs text-red-500">{{ form.errors.password }}</p>
                    </div>

                    <!-- Remember / Forgot -->
                    <div class="flex items-center justify-between mb-7">
                        <label class="flex items-center gap-2 text-[13px] text-slate-500 cursor-pointer">
                            <input v-model="form.remember" type="checkbox" class="accent-blue-600 w-[15px] h-[15px]" />
                            Remember me
                        </label>
                        <a href="#" class="text-[13px] text-blue-600 font-medium hover:underline">Forgot password?</a>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full py-[13px] bg-blue-600 text-white border-none rounded-[10px] text-[15px] font-semibold font-sora tracking-wide shadow-[0_4px_14px_rgba(37,99,235,0.35)] transition cursor-pointer hover:bg-blue-700 hover:shadow-[0_6px_20px_rgba(37,99,235,0.45)] active:scale-[0.985] disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        {{ form.processing ? 'Signing in…' : 'Sign in to Dashboard' }}
                    </button>
                </form>
            </div>
        </section>
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
        onError: (errors) => {
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: errors.email || 'Please check your credentials.',
                confirmButtonColor: '#2563eb',
            });
        }
    });
}
</script>
