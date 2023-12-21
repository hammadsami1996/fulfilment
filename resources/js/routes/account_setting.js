export default [
    {
        path: '/account_setting',
        name: 'view-account_setting',
        component: () => import('../views/account_setting/index.vue'),
        meta: {
            pageTitle: 'account setting',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'account setting',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/account_setting/create',
        name: 'create-account_setting',
        component: () => import('../views/account_setting/form.vue'),
        meta: {
            pageTitle: 'account setting',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'account setting',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/account_setting/:id/edit',
        name: 'edit-account_setting',
        component: () => import('../views/account_setting/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'account setting',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'account setting',
                    link: '/account_setting'
                },
                {
                    text: 'account setting Edit',
                    active: true,
                },
            ],
        },
    },


]
