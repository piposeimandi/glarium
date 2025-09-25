//Tienda que administra las notificaciones
import { createStore } from 'vuex'

export default createStore({
    state: {
        advisor:1,
        type:true,
        message:'',
    },
    mutations:{
        show(state,{advisor,type,message}){
            state.advisor = advisor;
            state.type = type;
            state.message = message;
        }
    }
})
