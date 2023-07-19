export default [
    {
        path: '/customer',
        name: 'view-customer',
        component: () => import('../views/customer/index.vue'),
        meta: {
            pageTitle: 'customer',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'customer',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/customer/create',
        name: 'create-customer',
        component: () => import('../views/customer/form.vue'),
        meta: {
            pageTitle: 'customer',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'customer',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/customer/:id/edit',
        name: 'edit-customer',
        component: () => import('../views/customer/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'customer',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'customer',
                    link: '/customer'
                },
                {
                    text: 'customer Edit',
                    active: true,
                },
            ],
        },
    },


]
