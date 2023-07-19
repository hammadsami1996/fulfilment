export default [
    {
        path: '/inventory',
        name: 'view-inventory',
        component: () => import('../views/inventory/index.vue'),
        meta: {
            pageTitle: 'inventory',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'inventory',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/inventory/create',
        name: 'create-inventory',
        component: () => import('../views/inventory/form.vue'),
        meta: {
            pageTitle: 'inventory',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'inventory',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/inventory/:id/edit',
        name: 'edit-inventory',
        component: () => import('../views/inventory/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'inventory',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'inventory',
                    link: '/inventory'
                },
                {
                    text: 'inventory Edit',
                    active: true,
                },
            ],
        },
    },


]
