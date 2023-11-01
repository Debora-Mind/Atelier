import { ComponentCustomProperties } from 'vue'
import { Store } from 'vuex'

declare module '@vue/runtime-core' {
    interface State {
        count: number
    }

    // fornece tipagem para `this.$store`
    interface ComponentCustomProperties {
        $store: Store<State>
    }
}