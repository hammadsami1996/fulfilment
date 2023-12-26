export default [
    {
        path: '/general_voucher',
        name: 'view-general_voucher',
        component: () => import('../views/general_voucher/index.vue'),
        meta: {
            pageTitle: 'general voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'general voucher',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/general_voucher/create',
        name: 'create-general_voucher',
        component: () => import('../views/general_voucher/form.vue'),
        meta: {
            pageTitle: 'general voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'general voucher',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/general_voucher/:id/edit',
        name: 'edit-general_voucher',
        component: () => import('../views/general_voucher/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'general voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'general voucher',
                    link: '/general_voucher'
                },
                {
                    text: 'general voucher Edit',
                    active: true,
                },
            ],
        },
    },


]
