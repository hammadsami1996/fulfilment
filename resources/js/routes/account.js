export default [
    {
        path: '/accounts',
        name: 'view-account',
        component: () => import('../views/account/index.vue'),
        meta: {
            pageTitle: 'account',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'account',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/accounts/create',
        name: 'create-account',
        component: () => import('../views/account/form.vue'),
        meta: {
            pageTitle: 'account',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'account',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/accounts/:id/edit',
        name: 'edit-account',
        component: () => import('../views/account/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'account',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'account',
                    link: '/account'
                },
                {
                    text: 'account Edit',
                    active: true,
                },
            ],
        },
    },


]
