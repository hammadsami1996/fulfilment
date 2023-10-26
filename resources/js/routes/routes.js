import {createRouter, createWebHistory} from 'vue-router';
import {useToast} from 'vue-toast-notification'; // Import the toast plugin
import user from '@/routes/user';
import role from '@/routes/role';
import plan from '@/routes/plan';

import permission from '@/routes/permission';
import user_dashboard from "@/routes/user_dashboard";
import user_type from "@/routes/user_type";
import product from "@/routes/product";
import warehouse from "@/routes/warehouse";
import stores from "@/routes/stores";
import company from "@/routes/company";
import inventory from "@/routes/inventory";
import supplier from "@/routes/supplier";
import purchase from "@/routes/purchase";
import order from "@/routes/order";
import customer from "@/routes/customer";
import customer_category from "@/routes/customer_category";
import courier_response from "@/routes/courier_response";
import report from "@/routes/report";
import ledger from "@/routes/ledger";
import settings from "@/routes/settings";
import fetch_order from "@/routes/fetch_order";
import receive_order from '@/routes/receive_order';
import product_category from "@/routes/product_category";
import brand from "@/routes/brand";
import replacement from "@/routes/replacement";
import cities from "@/routes/cities";


const toast = useToast(); // Initialize the toast plugin
const user_type_id = window.apex.user.user_type_id;

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/dashboard',
            component: () => {
                if (user_type_id == 3) {
                    return import('../views/user_dashboard/index.vue');
                } else {
                    return import('../views/Home.vue');
                }
            },
            name: 'view-home'
        },
        ...user,
        ...role,
        ...plan,
        ...permission,
        ...user_dashboard,
        ...user_type,
        ...product,
        ...warehouse,
        ...stores,
        ...company,
        ...inventory,
        ...supplier,
        ...purchase,
        ...order,
        ...customer,
        ...customer_category,
        ...receive_order,
        ...product_category,
        ...courier_response,
        ...brand,
        ...replacement,
        ...report,
        ...ledger,
        ...settings,
        ...fetch_order,
        ...cities,

        {
            path: '/error-404',
            name: 'error-404',
            component: () => import('../views/error/Error404.vue'),
            meta: {
                layout: 'full',
            },
        },
        {
            path: '/not-authorized',
            name: 'not-authorized',
            component: () => import('../views/error/NotAuthorized.vue'),
            meta: {
                layout: 'full',
            },
        },
        // {
        //     path: '/:catchAll(.*)',
        //     redirect: 'error-404',
        // },
    ],
});
router.beforeEach(async (to, from, next) => {

    const pageContent = document.getElementById('page-content');

    if (pageContent) {
        pageContent.classList.add('zoom-out-enter-active');
    }
    next()
    // try {
    //     // const response = await axios.get('/check-auth');
    //     // const isAuthenticated = response.data.authenticated;
    //     // console.log(window.apex.user.permissions)
    //
    //     // if (isAuthenticated) {
    //     if (
    //         to.name === 'error-404' ||
    //         to.name === 'not-authorized' ||
    //         to.name === 'view-home'
    //     ) {
    //         next();
    //     } else {
    //         let isAuthorized = false;
    //         const permissions = window.apex.user.permissions;
    //
    //         for (const entry of permissions) {
    //             if (to.name === entry.name) {
    //                 isAuthorized = true;
    //                 break;
    //             }
    //         }
    //
    //         if (isAuthorized) {
    //             next();
    //         } else {
    //             toast.error('Not authorized!', {position: 'top-right'}); // Show toast notification
    //             next({name: 'not-authorized'});
    //         }
    //     }
    //     // } else {
    //     //     toast.error('Not authorized!', {position: 'top-right'}); // Show toast notification
    //     //     next({name: 'not-authorized'});
    //     // }
    // } catch (error) {
    //     // toast.error('Not authorized!', {position: 'top-right'}); // Show toast notification
    //     next({name: 'not-authorized'});
    // }
});

router.afterEach((to, from) => {
    const pageContent = document.getElementById('page-content');

    if (pageContent) {
        setTimeout(() => {
            pageContent.classList.remove('zoom-out-enter-active');
        }, 500); // Adjust the duration to match your transition duration
    }
    // Perform actions after each route navigation
});

export default router;

