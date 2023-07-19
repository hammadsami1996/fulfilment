export default [
    {
        path: '/stores',
        name: 'view-stores',
        component: () => import('../views/stores/index.vue'),
        meta: {
            pageTitle: 'stores',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'stores',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/stores/create',
        name: 'create-stores',
        component: () => import('../views/stores/form.vue'),
        meta: {
            pageTitle: 'stores',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'stores',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/stores/:id/edit',
        name: 'edit-stores',
        component: () => import('../views/stores/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'stores',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'stores',
                    link: '/stores'
                },
                {
                    text: 'stores Edit',
                    active: true,
                },
            ],
        },
    },


]
