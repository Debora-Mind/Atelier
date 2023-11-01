import { useStore } from 'vuex';
import { key } from './store';
export default {
    setup() {
        const store = useStore(key);
        store.state.count; // tipado como number
    },
    state() {
        return {
            tipo: '',
            titulo: '',
            mensagem: '',
            retorno: null,
            modalAtivo: false,
        };
    },
    actions: {
        mostrarConfirmar(context, { tipo, titulo, mensagem, retorno }) {
            context.commit('setTipo', tipo);
            context.commit('setTitulo', titulo);
            context.commit('setMensagem', mensagem);
            context.commit('setRetorno', retorno);
            context.commit('setModalAtivo', true);
        },
        Confirmar(context) {
            context.commit('setRetorno', true);
            context.commit('setModalAtivo', false);
        },
        FecharModal(context) {
            context.commit('setRetorno', false);
            context.commit('setModalAtivo', false);
        },
    },
    mutations: {
        setTipo(state, tipo) {
            state.tipo = tipo;
        },
        setTitulo(state, titulo) {
            state.titulo = titulo;
        },
        setMensagem(state, mensagem) {
            state.mensagem = mensagem;
        },
        setRetorno(state, retorno) {
            state.retorno = retorno;
        },
        setModalAtivo(state, modalAtivo) {
            state.modalAtivo = modalAtivo;
        },
    },
};
//# sourceMappingURL=confirmar.js.map