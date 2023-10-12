export default [
    {
    path: '/customer_category/create',
    name: 'create-customer_category',
    component: () => import('../views/customer_category/form.vue'),
    meta: {
        pageTitle: 'Customer Category',
        breadcrumb: [
            {
                text: 'Home'
            },
            {
                text: 'Customer Category',
                active: true,
            },
        ],
    },
},
{
    path: '/customer_category',
    name: 'view-customer_category',
    component: () => import('../views/customer_category/index.vue'),
    meta: {
        pageTitle: 'Customer Category',
        breadcrumb: [
            {
                text: 'Home'
            },
            {
                text: 'Customer Category',
                active: true,
            },
        ],
    },
},
{
    path: '/category/:id/edit',
    name: 'edit-customer_category',
    component: () => import('../views/customer_category/form.vue'),
    meta: {
        mode: 'edit',
        pageTitle: 'customer_category',
        breadcrumb: [
            {
                text: 'Home'
            },
            {
                text: 'customer_category',
                link: '/customer_category'
            },
            {
                text: 'customer category Edit',
                active: true,
            },
        ],
    },
},
]
