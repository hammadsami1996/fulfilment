export default [
    {
        path: '/warehouse',
        name: 'view-warehouse',
        component: () => import('../views/warehouse/index.vue'),
        meta: {
            pageTitle: 'warehouse',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'warehouse',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/warehouse/create',
        name: 'create-warehouse',
        component: () => import('../views/warehouse/form.vue'),
        meta: {
            pageTitle: 'warehouse',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'warehouse',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/warehouse/:id/edit',
        name: 'edit-warehouse',
        component: () => import('../views/warehouse/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'warehouse',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'warehouse',
                    link: '/warehouse'
                },
                {
                    text: 'warehouse Edit',
                    active: true,
                },
            ],
        },
    },


]
