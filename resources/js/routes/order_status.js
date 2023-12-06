export default [
    {
        path: '/order_status',
        name: 'view-order_status',
        component: () => import('../views/order_status/index.vue'),
        meta: {
            pageTitle: 'order_status',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'order_status',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/cities/create',
        name: 'create-cities',
        component: () => import('../views/cities/form.vue'),
        meta: {
            pageTitle: 'cities',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'cities',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/cities/:id/edit',
        name: 'edit-cities',
        component: () => import('../views/cities/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'cities',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'cities',
                    link: '/cities'
                },
                {
                    text: 'cities Edit',
                    active: true,
                },
            ],
        },
    },


]
