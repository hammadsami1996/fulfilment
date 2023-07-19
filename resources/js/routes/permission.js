export default [
    {
        path: '/permission',
        name: 'view-permission',
        component: () => import('../views/permission/index.vue'),
        meta: {
            pageTitle: 'permission',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'permission',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/permission/create',
        name: 'create-permission',
        component: () => import('../views/permission/form.vue'),
        meta: {
            pageTitle: 'permission',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'permission',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/permission/:id/edit',
        name: 'edit-permission',
        component: () => import('../views/permission/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'permission',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'permission',
                    link: '/permission'
                },
                {
                    text: 'permission Edit',
                    active: true,
                },
            ],
        },
    },


]
