import axios from 'axios';
import moment from 'moment-timezone'

var pusher = new Pusher('b11b790e5dea909e2b7f', {
    cluster: 'us2',
    disableStats: true,
  });

const chUser = pusher.subscribe(document.querySelector('meta[name="user-notification"]').getAttribute('content'));
const chChat = pusher.subscribe('chat');

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
}
axios.defaults.baseURL = '/api/';

moment.tz.setDefault('America/Guayaquil')

// Export for use in components
export { chUser, chChat };
