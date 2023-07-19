export default [
    {
        path: '/plan',
        name: 'view-plan',
        component: () => import('../views/Plans/index.vue'),
        meta: {
            pageTitle: 'Plans',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Plans',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/plan/create',
        name: 'create-plan',
        component: () => import('../views/Plans/form.vue'),
        meta: {
            pageTitle: 'Plans',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Plans',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/plan/:id/edit',
        name: 'edit-plan',
        component: () => import('../views/Plans/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'Plans',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Plans',
                    link: '/plan'
                },
                {
                    text: 'Plans Edit',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/user_subscription',
        name: 'view-user_subscription',
        component: () => import('../views/Plans/user_plan.vue'),
        meta: {
            pageTitle: 'User_plan',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'User_plan',
                    active: true,
                },
            ],
        },
    },
    // {
    //     path: '/roles/:id',
    //     name: 'display-roles',
    //     component: () => import('../views/Role/display.vue'),
    //     meta: {
    //         pageTitle: 'Role',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'Role',
    //                 link: '/roles'
    //             },
    //             {
    //                 text: 'Role Display',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
]
