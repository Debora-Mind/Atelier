import { InjectionKey } from 'vue'
import { createStore, Store } from 'vuex'
import confirmar from "./confirmar";

// defina suas tipagens para o estado do store
export interface State {
    count: number
}

// defina o injection key
export const key: InjectionKey<Store<State>> = Symbol()

export const store = createStore<State>({
    state: {
        count: 0
    },
    modules: {
        confirmar
    }
})
