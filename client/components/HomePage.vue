<template>
    <v-content fluid class="pa-2">
        <v-layout row justify-center>
            <v-flex xs10>
                <Form @shorten="shorten($event)" @show="show($event)"/>
            </v-flex>
        </v-layout>
        <v-dialog v-model="dialog">
            <Card :url="result" :title="title"/>
        </v-dialog>
    </v-content>
</template>

<script>
import Card from './Card'
import Form from './Form'
import axios from '../plugins/axios'

/* eslint-disable no-console */
export default {
    components: {
        Card,
        Form
    },

    data() {
        return {
            baseUrl: process.env.VUE_APP_API_URL,
            result: null,
            title: null,
            dialog: false
        }
    },

    methods: {
        shorten(url) {
            axios.post(this.baseUrl, {url}).then(result => {
                this.result = result.data ? result.data.short_url : null
                this.title = 'Shortened Url'
            }).catch(err => {
                this.title = 'Error'
                this.result = 'Not a valid Url'
            }).finally(() => {
                this.dialog = true
            })
        },

        show(url) {
            axios.get(`${this.baseUrl}/${url}`).then(result => {
                this.result = result.data ? result.data.url : null
                this.title = 'Full URL'
            }).catch(err => {
                this.title = 'Error'
                this.result = err.response && err.response.status === 404 ? 'Url not found' : err.message
            }).finally(() => {
                this.dialog = true
            })
        }
    }
}
</script>