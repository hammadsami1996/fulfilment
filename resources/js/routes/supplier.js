export default [
    {
        path: '/supplier',
        name: 'view-supplier',
        component: () => import('../views/supplier/index.vue'),
        meta: {
            pageTitle: 'supplier',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'supplier',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/supplier/create',
        name: 'create-supplier',
        component: () => import('../views/supplier/form.vue'),
        meta: {
            pageTitle: 'supplier',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'supplier',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/supplier/:id/edit',
        name: 'edit-supplier',
        component: () => import('../views/supplier/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'supplier',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'supplier',
                    link: '/supplier'
                },
                {
                    text: 'supplier Edit',
                    active: true,
                },
            ],
        },
    },


]
