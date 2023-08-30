export default [
    {
        path: '/coa',
        name: 'view-chart_of_accounts',
        component: () => import('../views/ledger/coa.vue'),
        meta: {
            pageTitle: 'chart_of_accounts',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'chart_of_accounts',
                    active: true,
                },
            ],
        },
    },
   


]
