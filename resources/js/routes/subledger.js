export default [
    {
        path: '/subledger',
        name: 'view-subledger',
        component: () => import('../views/subledger/index.vue'),
        meta: {
            pageTitle: 'subledger',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'subledger',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/subledger/create',
        name: 'create-subledger',
        component: () => import('../views/subledger/form.vue'),
        meta: {
            pageTitle: 'subledger',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'subledger',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/subledger/:id/edit',
        name: 'edit-subledger',
        component: () => import('../views/subledger/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'subledger',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'subledger',
                    link: '/subledger'
                },
                {
                    text: 'subledger Edit',
                    active: true,
                },
            ],
        },
    },


]
