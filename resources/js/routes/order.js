export default [
    {
        path: '/order',
        name: 'view-order',
        component: () => import('../views/order/index.vue'),
        meta: {
            pageTitle: 'order',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'order',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/order/create',
        name: 'create-order',
        component: () => import('../views/order/form.vue'),
        meta: {
            pageTitle: 'order',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'order',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/order/:id/edit',
        name: 'edit-order',
        component: () => import('../views/order/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'order',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'order',
                    link: '/order'
                },
                {
                    text: 'order Edit',
                    active: true,
                },
            ],
        },
    },

    {
        path: '/order/:id/show',
        name: 'edit-order',
        component: () => import('../views/order/show.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'order',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'order',
                    link: '/order'
                },
                {
                    text: 'order Show',
                    active: true,
                },
            ],
        },
    },



]
