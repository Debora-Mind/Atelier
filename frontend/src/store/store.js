import { createStore } from 'vuex';
import confirmar from "./confirmar";
// defina o injection key
export const key = Symbol();
export const store = createStore({
    state: {
        count: 0
    },
    modules: {
        confirmar
    }
});
//# sourceMappingURL=store.js.map