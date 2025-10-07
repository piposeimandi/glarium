<template>
  <div>
    <div class="cityContainer">
        <div id="zoom">
            <div class="city">
                <Edificios></Edificios>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Edificios from "Components/city/Edificios.vue";

export default {
  name: "City",
  components: {
    Edificios,
  },
  mounted() {
    if (typeof this.$zoom === "function") {
      try {
        this.$zoom();
      } catch (error) {
        console.error("Error ejecutando $zoom:", error);
      }
    } else {
      console.warn("El método $zoom no está definido. Verifica su implementación global.");
    }
  },
};
</script>

<style lang="css" scoped>
.cityContainer {
  cursor: all-scroll;
  height: 100%;
  width: 100%;
  position: absolute;
  overflow: hidden;
}
.city {
  width: 2460px;
  height: 1794px;
  background: url("/resources/game/img/ciudad/city.jpg");
  background-size: cover;
  background-position: center;
}
</style>
