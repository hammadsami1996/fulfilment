export default [
    {
        path: '/user_type',
        name: 'view-user_type',
        component: () => import('../views/User_type/index.vue'),
        meta: {
            pageTitle: 'User_type',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'User_type',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/user_type/create',
        name: 'create-user_type',
        component: () => import('../views/User_type/form.vue'),
        meta: {
            pageTitle: 'User_type',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'User_type',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/user_type/:id/edit',
        name: 'edit-user_type',
        component: () => import('../views/User_type/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'User_type',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'User_type',
                    link: '/user_type'
                },
                {
                    text: 'User_type Edit',
                    active: true,
                },
            ],
        },
    },



]
