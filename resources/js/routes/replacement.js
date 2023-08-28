export default [
    {
        path: '/replacement',
        name: 'view-replacement',
        component: () => import('../views/replacement_order/replacement.vue'),
        meta: {
            pageTitle: 'replacement',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'replacement',
                    active: true,
                },
            ],
        },
    },
]
