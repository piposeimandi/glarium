import { createStore } from 'vuex'
import moment from 'moment'

const store = createStore({
    state: {
      now: moment().format('YYYY-MM-DD HH:mm:ss'),
    },
    mutations:
    {
      reloadIslandData(){},
      reloadUserResources(){},
      reloadPopulation(){},
    }
})

setInterval(function () {
    store.state.now = moment().format('YYYY-MM-DD HH:mm:ss')
}, 1000)

export default store;
