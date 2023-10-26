export default [
    {
        path: '/courier_response',
        name: 'view-courier_response',
        component: () => import('../views/courier_response/index.vue'),
        meta: {
            pageTitle: 'courier_response',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'courier_response',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/courier_response/create',
        name: 'create-courier_response',
        component: () => import('../views/courier_response/form.vue'),
        meta: {
            pageTitle: 'courier_response',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'courier_response',
                },
                {
                    text: 'Create',
                    active: true,
                },
            ],
        },
    },
    {
        path: '/courier_response/:id/edit',
        name: 'edit-courier_response',
        component: () => import('../views/courier_response/form.vue'),
        meta: {
            mode: 'edit',
            pageTitle: 'courier_response',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'courier_response',
                    link: '/courier_response'
                },
                {
                    text: 'courier_response Edit',
                    active: true,
                },
            ],
        },
    },


]
