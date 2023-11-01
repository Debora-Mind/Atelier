import { useStore } from 'vuex'
import { key } from './store'

export default {
    setup () {
        const store = useStore(key)
        store.state.count // tipado como number
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
        mostrarConfirmar(context: any, { tipo, titulo, mensagem, retorno }: any) {
            context.commit('setTipo', tipo);
            context.commit('setTitulo', titulo);
            context.commit('setMensagem', mensagem);
            context.commit('setRetorno', retorno);
            context.commit('setModalAtivo', true);
        },
        Confirmar(context: any) {
            context.commit('setRetorno', true);
            context.commit('setModalAtivo', false);
        },
        FecharModal(context: any) {
            context.commit('setRetorno', false);
            context.commit('setModalAtivo', false);
        },
    },
    mutations: {
        setTipo(state: any, tipo: string) {
            state.tipo = tipo;
        },
        setTitulo(state: any, titulo: string) {
            state.titulo = titulo;
        },
        setMensagem(state: any, mensagem: string) {
            state.mensagem = mensagem;
        },
        setRetorno(state: any, retorno: any) {
            state.retorno = retorno;
        },
        setModalAtivo(state: any, modalAtivo: boolean) {
            state.modalAtivo = modalAtivo;
        },
    },
};
