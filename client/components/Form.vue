<template>
    <v-container fluid>
        <v-card>
            <v-card-text>
                <v-layout row align-center justify-center>
                    <v-flex xs10>
                        <v-text-field v-model="url" label="Url" required></v-text-field>
                        <v-btn @click="submit('shorten')">Shorten</v-btn>
                        <v-btn @click="submit('show')">Get full Url</v-btn>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            url: ''
        }
    },

    methods: {
        submit(action) {
            console.log('url', this.url)
            if(this.url) {
                this.$emit(action, this.url)
                this.url = ''
            }
        }
    }
}
</script>
