export default [
    {
        path: '/update_profile',
        name: 'view-update_profile',
        component: () => import('../views/update_profile/update_profile.vue'),
        meta: {
            pageTitle: 'Update Profile',
            breadcrumb: [
                {
                    text: 'Home'
                },
                {
                    text: 'Update Profile',
                    active: true,
                },
            ],
        },
    },
]
