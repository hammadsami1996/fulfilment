export default [
    {
        path: '/role',
        name: 'view-role',
        component: () => import('../views/Role/index.vue'),
        meta: {
            pageTitle: 'Role',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Role',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/role/create',
        name: 'create-role',
        component: () => import('../views/Role/form.vue'),
        meta: {
            pageTitle: 'Role',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Role',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/role/:id/edit',
        name: 'edit-role',
        component: () => import('../views/Role/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'Role',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Role',
                    link: '/role'
                },
                {
                    text: 'Role Edit',
                    active: true,
                },
            ],
        },
    },
    // {
    //     path: '/role/:id',
    //     name: 'display-role',
    //     component: () => import('../views/Role/display.vue'),
    //     meta: {
    //         pageTitle: 'Role',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'Role',
    //                 link: '/role'
    //             },
    //             {
    //                 text: 'Role Display',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
]
