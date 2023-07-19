export default [
    {
        path: '/job_user',
        name: 'view-job_user',
        component: () => import('../views/job_user/index.vue'),
        meta: {
            pageTitle: 'job_user',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'job_user',
                    active: true,
                },
            ],
        },
    },
    // {
    //     path: '/job/create',
    //     name: 'create-job',
    //     component: () => import('../views/job_user/form.vue'),
    //     meta: {
    //         pageTitle: 'job',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'job',
    //             },
    //             {
    //                 text: 'Create',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
    // {
    //     path: '/job/:id/edit',
    //     name: 'edit-job',
    //     component: () => import('../views/job/form.vue'),
    //     meta: {
    //         mode: 'edit',
    //         pageTitle: 'job',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'job',
    //                 link: '/job'
    //             },
    //             {
    //                 text: 'job Edit',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
    // {
    //     path: '/user_job',
    //     name: 'view-user_job',
    //     component: () => import('../views/job/user_job.vue'),
    //     meta: {
    //         pageTitle: 'User_job',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'User_job',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
    // {
    //     path: '/apply_job',
    //     name: 'view-apply_job',
    //     component: () => import('../views/job/apply_job.vue'),
    //     meta: {
    //         pageTitle: 'Apply_job',
    //         breadcrumb: [
    //             {
    //                 text: 'Home'
    //             },
    //             {
    //                 text: 'Apply_job',
    //                 active: true,
    //             },
    //         ],
    //     },
    // },
]
