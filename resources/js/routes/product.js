export default [
    {
        path: '/product',
        name: 'view-product',
        component: () => import('../views/product/index.vue'),
        meta: {
            pageTitle: 'product',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'product',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/product/create',
        name: 'create-product',
        component: () => import('../views/product/form.vue'),
        meta: {
            pageTitle: 'product',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'product',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/product/:id/edit',
        name: 'edit-product',
        component: () => import('../views/product/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'product',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'product',
                    link: '/product'
                },
                {
                    text: 'product Edit',
                    active: true,
                },
            ],
        },
    },


]
