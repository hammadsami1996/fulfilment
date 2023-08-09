export default [
    {
        path: '/receive_order',
        name: 'view-receive_order',
        component: () => import('../views/recieve_order/index.vue'),
        meta: {
            pageTitle: 'receive_order',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'receive_order',
                    active: true,
                },
            ],
        },
    },
   


]
