export default [
    {
        path: '/cities',
        name: 'view-cities',
        component: () => import('../views/cities/index.vue'),
        meta: {
            pageTitle: 'cities',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'cities',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/cities/create',
        name: 'create-cities',
        component: () => import('../views/cities/form.vue'),
        meta: {
            pageTitle: 'cities',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'cities',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/cities/:id/edit',
        name: 'edit-cities',
        component: () => import('../views/cities/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'cities',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'cities',
                    link: '/cities'
                },
                {
                    text: 'cities Edit',
                    active: true,
                },
            ],
        },
    },


]
