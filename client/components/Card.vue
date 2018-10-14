<template>
    <v-container fluid class="pa-0">
        <v-card>
            <v-card-title primary-title>
                <h2>{{title}}</h2>
            </v-card-title>
            <v-card-text>
                <h1>{{url}}</h1>
            </v-card-text>
        </v-card>
    </v-container>
</template>


<script>
import Form from './Form'
export default {
    props: {
        url: String,
        title: String
    },
    computed: {
        result() {
            return this.url
        }
    },
    components: {
        Form
    }
}
</script>
