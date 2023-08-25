export default [
    {
        path: '/required_item_stock',
        name: 'view-required_item_stock',
        component: () => import('../views/report/required_item_stock.vue'),
        meta: {
            pageTitle: 'required_item_stock',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'required_item_stock',
                    active: true,
                },
            ],
        },
    },
   


]
