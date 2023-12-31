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
    // {
    //     path: '/customer_category/create',
    //     name: 'create-customer_category',
    //     component: () => import('../views/customer_category/form.vue'),
    //     meta: {
    //         pageTitle: 'Customer Category',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'Customer Category',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
    // {
    //     path: '/customer_category',
    //     name: 'view-customer_category',
    //     component: () => import('../views/customer_category/index.vue'),
    //     meta: {
    //         pageTitle: 'Customer Category',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'Customer Category',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
    // {
    //     path: '/category/:id/edit',
    //     name: 'edit-customer_category',
    //     component: () => import('../views/customer_category/form.vue'),
    //     meta: {
    //         mode: 'edit',
    //         pageTitle: 'customer_category',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'customer_category',
    //                 link: '/customer_category'
    //             },
    //             {
    //                 text: 'customer category Edit',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },


]
