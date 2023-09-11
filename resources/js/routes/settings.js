export default [
    {
        path: '/global_settings',
        name: 'view-global_settings',
        component: () => import('../views/company_settings/global_settings.vue'),
        meta: {
            pageTitle: 'global_settings',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'global_settings',
                    active: true,
                },
            ],
        },
    },
   


]
