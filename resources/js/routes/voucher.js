export default [
    {
        path: '/voucher',
        name: 'view-voucher',
        component: () => import('../views/voucher/index.vue'),
        meta: {
            pageTitle: 'voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'voucher',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/voucher/create',
        name: 'create-voucher',
        component: () => import('../views/voucher/form.vue'),
        meta: {
            pageTitle: 'voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'voucher',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/voucher/:id/edit',
        name: 'edit-voucher',
        component: () => import('../views/voucher/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'voucher',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'voucher',
                    link: '/voucher'
                },
                {
                    text: 'voucher Edit',
                    active: true,
                },
            ],
        },
    },


]
