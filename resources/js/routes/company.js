export default [
    {
        path: '/company',
        name: 'view-company',
        component: () => import('../views/company/index.vue'),
        meta: {
            pageTitle: 'company',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'company',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/company/create',
        name: 'create-company',
        component: () => import('../views/company/form.vue'),
        meta: {
            pageTitle: 'company',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'company',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/company/:id/edit',
        name: 'edit-company',
        component: () => import('../views/company/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'company',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'company',
                    link: '/company'
                },
                {
                    text: 'company Edit',
                    active: true,
                },
            ],
        },
    },


]
