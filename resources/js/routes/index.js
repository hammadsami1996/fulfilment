import user from "@/routes/user";
import roles from "@/routes/roles";
import setting from "@/routes/setting";
import plan from "@/routes/plan";
import basic_info from "@/routes/basic_info";
import job from "@/routes/jobs";
import job_user from "@/routes/job_user";
import location from "@/routes/location";
import job_type from "@/routes/job_type";
import job_role from "@/routes/job_role";
import job_skill from "@/routes/job_skill";
import job_specialities from "@/routes/job_specialities";
import permission from "@/routes/permission";

const routes = [
    {
        path: '/dashboard',
        component: () => import('../views/Home.vue'),
        name: 'view-home',
    },

    ...user,
    ...roles,
    ...setting,
    ...plan,
    ...basic_info,
    ...job,
    ...job_user,
    ...location,
    ...job_type,
    ...job_role,
    ...job_skill,
    ...job_specialities,
    ...permission,
    {
        path: '/error-404',
        name: 'error-404',
        component: () => import('../../views/error/Error404.vue'),
        meta: {
            layout: 'full',
        },
    },
    {
        path: '/not-authorized',
        name: 'not-authorized',
        component: () => import('../../views/error/NotAuthorized.vue'),
        meta: {
            layout: 'full',
        },
    },
    {
        path: '/*',
        redirect: 'error-404',
    },
];
export default routes;
