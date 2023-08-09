export default [
    {
        path: '/product_category',
        name: 'view-product_category',
        component: () => import('../views/product_category/index.vue'),
        meta: {
            pageTitle: 'product_category',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'product_category',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/product_category/create',
        name: 'create-product_category',
        component: () => import('../views/product_category/form.vue'),
        meta: {
            pageTitle: 'product_category',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'product_category',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/product_category/:id/edit',
        name: 'edit-product_category',
        component: () => import('../views/product_category/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'product_category',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'product_category',
                    link: '/product_category'
                },
                {
                    text: 'product_category Edit',
                    active: true,
                },
            ],
        },
    },
]
