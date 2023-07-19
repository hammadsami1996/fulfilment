export default [
    {
        path: '/user_dashboard',
        name: 'view-user_dashboard',
        component: () => import('../views/user_dashboard/index.vue'),
        meta: {
            pageTitle: 'User Dashboard',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'User Dashboard',
                    active: true,
                },
            ],
        },
    },
    ]
