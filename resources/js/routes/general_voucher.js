export default [
    {
        path: '/general_voucher',
        name: 'view-general_voucher',
        component: () => import('../views/general_voucher/index.vue'),
        meta: {
            pageTitle: 'general_voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'general_voucher',
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
            pageTitle: 'general_voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'general_voucher',
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
            pageTitle: 'general_voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'general_voucher',
                    link: '/general_voucher'
                },
                {
                    text: 'general_voucher Edit',
                    active: true,
                },
            ],
        },
    },


]
