export default [
    {
        path: '/journal_voucher',
        name: 'view-journal_voucher',
        component: () => import('../views/journal_voucher/index.vue'),
        meta: {
            pageTitle: 'journal_voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'journal_voucher',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/journal_voucher/create',
        name: 'create-journal_voucher',
        component: () => import('../views/journal_voucher/form.vue'),
        meta: {
            pageTitle: 'journal_voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'journal_voucher',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/journal_voucher/:id/edit',
        name: 'edit-journal_voucher',
        component: () => import('../views/journal_voucher/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'journal_voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'journal_voucher',
                    link: '/journal_voucher'
                },
                {
                    text: 'Journal Voucher Edit',
                    active: true,
                },
            ],
        },
    },


]
