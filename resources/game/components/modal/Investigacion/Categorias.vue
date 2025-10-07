<template>
    <div class="box">
        <div class="mb-2 categoria">
            <div @click='changeCategory(1)'><img :src="getImg('area_seafaring.jpg')"></div>
        </div>
        <div class="mb-2 categoria">
            <div @click='changeCategory(2)'><img :src="getImg('area_economy.jpg')"></div>
        </div>
        <div class="mb-2 categoria">
            <div @click='changeCategory(3)'><img :src="getImg('area_knowledge.jpg')"></div>
        </div>
        <div class="mb-2 categoria">
            <div @click='changeCategory(4)'><img :src="getImg('area_military.jpg')"></div>
        </div>
    </div>
</template>

<script>
export default {
    name:'Categorias',
    props:['changeCategory'],
    methods: {
        getImg(name) {
            return new URL(`@/resources/game/img/icon/${name}`, import.meta.url).href;
        }
    }
}
</script>

<style lang="scss" scoped>
 .box{
    font-size: 0.83rem;
 }
 .categoria{
    cursor: pointer;
 }
</style>