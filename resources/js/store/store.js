import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';

const store = createStore({
    state() {
        return {
            count: 0,
        };
    },
    mutations: {
        increment(state) {
            state.count++;
        },
    },
    actions: {
        increment({ commit }) {
            commit('increment');
        },
    },
    plugins: [createPersistedState()],
});

export default store;
