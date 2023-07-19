export default [
    {
        path: '/purchase',
        name: 'view-purchase',
        component: () => import('../views/purchase/index.vue'),
        meta: {
            pageTitle: 'purchase',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'purchase',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/purchase/create',
        name: 'create-purchase',
        component: () => import('../views/purchase/form.vue'),
        meta: {
            pageTitle: 'purchase',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'purchase',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/purchase/:id/edit',
        name: 'edit-purchase',
        component: () => import('../views/purchase/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'purchase',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'purchase',
                    link: '/purchase'
                },
                {
                    text: 'purchase Edit',
                    active: true,
                },
            ],
        },
    },


]
