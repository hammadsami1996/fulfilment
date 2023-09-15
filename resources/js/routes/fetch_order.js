export default [
    {
        path: '/fetch_order',
        name: 'view-fetch_order',
        component: () => import('../views/fetch_order/index.vue'),
        meta: {
            pageTitle: 'fetch_order',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'fetch_order',
                    active: true,
                },
            ],
        },
    },
    // {
    //     path: '/fetch_order/create',
    //     name: 'create-fetch_order',
    //     component: () => import('../views/fetch_order/form.vue'),
    //     meta: {
    //         pageTitle: 'fetch_order',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'fetch_order',
    //             },
    //             {
    //                 text: 'Create',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
    // {
    //     path: '/fetch_order/:id/edit',
    //     name: 'edit-order',
    //     component: () => import('../views/fetch_order/form.vue'),
    //     meta: {
    //         mode: 'edit',
    //         pageTitle: 'fetch_order',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'fetch_order',
    //                 link: '/fetch_order'
    //             },
    //             {
    //                 text: 'order Edit',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },

    // {
    //     path: '/fetch_order/:id/show',
    //     name: 'show-order',
    //     component: () => import('../views/fetch_order/show.vue'),
    //     meta: {
    //         mode: 'edit',
    //         pageTitle: 'fetch_order',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'fetch_order',
    //                 link: '/fetch_order'
    //             },
    //             {
    //                 text: 'order Show',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },



]
