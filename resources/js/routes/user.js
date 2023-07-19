export default [
    {
        path: '/user',
        name: 'view-user',
        component: () => import('../views/Users/index.vue'),
        meta: {
            pageTitle: 'Users',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Users',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/user/create',
        name: 'create-user',
        component: () => import('../views/Users/form.vue'),
        meta: {
            pageTitle: 'Users',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Users',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/user/:id/edit',
        name: 'edit-user',
        component: () => import('../views/Users/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'Users',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Users',
                    link: '/user'
                },
                {
                    text: 'Users Edit',
                    active: true,
                },
            ],
        },
    },

    {
        path: '/change_password',
        name: 'change_password',
        component: () => import('../views/Users/change_password.vue'),

    },

]
