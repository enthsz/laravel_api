import './bootstrap';
import { createApp } from 'vue'
import App from './components/app.vue'

import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faSquarePlus, faPencil, faTrash, faCheck } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faSquarePlus, faPencil, faTrash, faCheck)

const app = createApp(App)
app.component('app', App); 
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app')
