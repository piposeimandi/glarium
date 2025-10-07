<template>
    <div>
        <Modal></Modal>
        <MenuSuperior></MenuSuperior>
        <Chat></Chat>
        <router-view></router-view>
    </div>
</template>

<script>
import axios from 'axios'
import router from 'Js/router.js'
import MenuSuperior from "Components/layout/MenuSuperior.vue"
import $notification from 'Stores/notification'
import $resources from 'Stores/resources'
import $building from 'Stores/building'
import Modal from "Components/modal/Modal.vue";
import Chat from "Components/chat/Chat.vue";
import $city from 'Stores/city'

export default {
    name:'Game',
    router,
    components:{
        MenuSuperior,
        Modal,
        Chat
    },
    mounted(){
        try {
            let city_id;
            this.$nextTick(() => {
                console.log("Ruta actual:", this.$route);
                console.log("Parámetros de la ruta:", this.$route.params);
                if (this.$route.path === '/' && this.$route.fullPath !== '/game/city/1') {
                    console.warn("La ruta actual es '/', redirigiendo a '/game/city/1'.");
                    this.$router.push('/game/city/1');
                    return;
                }
                if (localStorage.city_id === undefined) {
                    city_id = this.$route?.params?.city || null;
                    if (!city_id) {
                        console.warn("No se pudo obtener city_id de la ruta. Por favor, verifica la URL.");
                        return; // Evita redirigir para no interferir con el flujo de inicio de sesión
                    }
                } else {
                    city_id = localStorage.city_id;
                }
                console.log("city_id obtenido:", city_id);
                $city.commit('setCityId', { city_id });
                $building.dispatch('updateBuilding');
            });
        } catch (error) {
            console.error("Error en el hook mounted de Game.vue:", error);
        }
    }
}
</script>
