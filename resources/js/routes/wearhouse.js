export default [
    {
        path: '/wearhouse',
        name: 'view-wearhouse',
        component: () => import('../views/wearhouse/index.vue'),
        meta: {
            pageTitle: 'wearhouse',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'wearhouse',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/wearhouse/create',
        name: 'create-wearhouse',
        component: () => import('../views/wearhouse/form.vue'),
        meta: {
            pageTitle: 'wearhouse',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'wearhouse',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/wearhouse/:id/edit',
        name: 'edit-wearhouse',
        component: () => import('../views/wearhouse/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'wearhouse',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'wearhouse',
                    link: '/wearhouse'
                },
                {
                    text: 'wearhouse Edit',
                    active: true,
                },
            ],
        },
    },


]
