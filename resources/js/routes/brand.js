export default [
    {
        path: '/brand',
        name: 'view-brand',
        component: () => import('../views/brand/index.vue'),
        meta: {
            pageTitle: 'brand',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'brand',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/brand/create',
        name: 'create-brand',
        component: () => import('../views/brand/form.vue'),
        meta: {
            pageTitle: 'brand',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'brand',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/brand/:id/edit',
        name: 'edit-brand',
        component: () => import('../views/brand/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'brand',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'brand',
                    link: '/brand'
                },
                {
                    text: 'brand Edit',
                    active: true,
                },
            ],
        },
    },


]
