<template>

    <Head title="CRUD Example" />
    <AppLayout>
        <div>
            <div class="mb-7 flex justify-between items-end">
                <div>
                    <h2 class="font-sora text-2xl font-bold text-[#0f2044] tracking-tight">Customers</h2>
                    <p class="text-sm text-slate-500 mt-1">Manage your customer records.</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="relative w-80">
                        <input type="text" v-model="search" placeholder="Search customer..." class="w-full pl-10 pr-4 py-2 text-sm border-[1.5px] border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <button @click="openCreateModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 transition h-[38px] shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                        Create Customer
                    </button>
                </div>
            </div>

        <!-- Table -->
        <div class="bg-white rounded-xl border-[1.5px] border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50 text-slate-600 font-medium border-b-[1.5px] border-slate-200">
                        <tr>
                            <th class="px-6 py-4 w-16">No</th>
                            <th class="px-6 py-4 cursor-pointer hover:bg-slate-100 transition" @click="sortBy('name')">
                                <div class="flex items-center gap-2">
                                    Name
                                    <span v-if="filters.sort === 'name'">
                                        <svg v-if="filters.direction === 'asc'" class="w-3 h-3 text-blue-600"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                        <svg v-else class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </div>
                            </th>
                            <th class="px-6 py-4 cursor-pointer hover:bg-slate-100 transition"
                                @click="sortBy('address')">
                                <div class="flex items-center gap-2">
                                    Address
                                    <span v-if="filters.sort === 'address'">
                                        <svg v-if="filters.direction === 'asc'" class="w-3 h-3 text-blue-600"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                        <svg v-else class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <tr v-for="(customer, index) in customers.data" :key="customer.id"
                            class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">{{ customers.from + index }}</td>
                            <td class="px-6 py-4 font-medium">{{ customer.name }}</td>
                            <td class="px-6 py-4 text-slate-500 whitespace-normal min-w-[200px]">{{ customer.address }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button @click="openEditModal(customer)"
                                    class="text-blue-600 hover:text-blue-800 p-1.5 hover:bg-blue-50 rounded transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button @click="deleteCustomer(customer)"
                                    class="text-red-500 hover:text-red-700 p-1.5 hover:bg-red-50 rounded transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr v-if="customers.data.length === 0">
                            <td colspan="4" class="px-6 text-center text-slate-500 h-[200px] align-middle bg-slate-50/30">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2-2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <span v-if="search">No customers found matching "{{ search }}".</span>
                                    <span v-else>No customers added yet. Click "Create Customer" to start.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t-[1.5px] border-slate-200 bg-slate-50 flex items-center justify-between"
                v-if="customers.total > 0">
                <div class="text-xs text-slate-500">
                    Showing <span class="font-medium text-slate-900">{{ customers.from }}</span> to <span
                        class="font-medium text-slate-900">{{ customers.to }}</span> of <span
                        class="font-medium text-slate-900">{{ customers.total }}</span> results
                </div>
                <div class="flex gap-1">
                    <template v-for="(link, i) in customers.links" :key="i">
                        <Link v-if="link.url" :href="link.url" v-html="link.label"
                            :class="['px-3 py-1.5 text-xs font-medium rounded-md transition', link.active ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50']" />
                        <span v-else v-html="link.label"
                            class="px-3 py-1.5 text-xs font-medium rounded-md bg-transparent text-slate-400 cursor-not-allowed"></span>
                    </template>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <Transition enter-active-class="transition duration-200 ease-out" enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100" leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
            <div v-if="isModalOpen" class="fixed inset-0 z-[200] flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="closeModal"></div>
                <div
                    class="relative bg-white rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.15)] w-full max-w-lg overflow-hidden z-10">
                    <div
                        class="px-6 py-4 border-b-[1.5px] border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-sora font-semibold text-lg text-slate-900">{{ editingId ? 'Edit Customer' : 'Create Customer' }}</h3>
                        <button @click="closeModal"
                            class="text-slate-400 hover:text-slate-600 p-1 rounded-md hover:bg-slate-100 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <form @submit.prevent="submitForm" class="p-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Name</label>
                            <input type="text" v-model="form.name"
                                class="w-full px-4 py-2 text-sm border-[1.5px] border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                                placeholder="John Doe">
                            <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Address</label>
                            <textarea v-model="form.address" rows="3"
                                class="w-full px-4 py-2 text-sm border-[1.5px] border-slate-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition resize-none"
                                placeholder="123 Main St..."></textarea>
                            <div v-if="form.errors.address" class="text-red-500 text-xs mt-1">{{ form.errors.address }}
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" @click="closeModal"
                                class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border-[1.5px] border-slate-200 rounded-lg hover:bg-slate-50 transition">Cancel</button>
                            <button type="submit" :disabled="form.processing"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition disabled:opacity-70 flex items-center gap-2">
                                <svg v-if="form.processing" class="animate-spin h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4">
                                    </circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                {{ editingId ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Transition>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, watch } from 'vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    customers: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');

let searchTimeout = null;
const performSearch = () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(route('customers.index'), {
            search: search.value,
            sort: props.filters.sort,
            direction: props.filters.direction,
        }, { preserveState: true, replace: true });
    }, 400); // 400ms debounce
};

watch(search, (value) => {
    performSearch();
});

function sortBy(field) {
    let direction = 'asc';
    if (props.filters.sort === field && props.filters.direction === 'asc') {
        direction = 'desc';
    }

    router.get(route('customers.index'), {
        search: search.value,
        sort: field,
        direction: direction,
    }, { preserveState: true, replace: true });
}

// Modal Form
const isModalOpen = ref(false);
const editingId = ref(null);

const form = useForm({
    name: '',
    address: '',
});

function openCreateModal() {
    editingId.value = null;
    form.name = '';
    form.address = '';
    form.clearErrors();
    isModalOpen.value = true;
}

function openEditModal(customer) {
    editingId.value = customer.id;
    form.name = customer.name;
    form.address = customer.address;
    form.clearErrors();
    isModalOpen.value = true;
}

function closeModal() {
    isModalOpen.value = false;
    setTimeout(() => {
        form.name = '';
        form.address = '';
        form.clearErrors();
    }, 200); // Wait for transition
}

function submitForm() {
    if (editingId.value) {
        form.put(route('customers.update', editingId.value), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('customers.store'), {
            onSuccess: () => closeModal(),
        });
    }
}

function deleteCustomer(customer) {
    Swal.fire({
        title: 'Delete Customer',
        text: `Are you sure you want to delete ${customer.name}? This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Yes, Delete it'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('customers.destroy', customer.id));
        }
    });
}
</script>
