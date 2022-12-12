import { defineStore } from "pinia";
import server from "@/config/server";
import axios from "axios";

export const useUserStore = defineStore('userStore', {
    state: () => ({        
        user: {},
        token: null,
        errMsg:[]
    }),
    getters: {

    },
    actions: {
        async register(data) {                 
            
            var config = {
                method: "post",
                url: `${server}register`,
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                },
                data: data,
            };

            try {
                const response = await axios(config)
                                
                this.user = response.data.user    
                this.token = response.data.token    
            } catch (error) {                
                //this.errMsg= JSON.parse(error.response.data.errors)                 
                for (const [key, value] of Object.entries(error.response.data.errors)) {
                    console.log(key, value.toString())
                    this.errMsg.push(value.toString())
                }
                console.log(error);
            }           
        },
        async login(data) {                 
            
            var config = {
                method: "post",
                url: `${server}login`,
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                },
                data: data,
            };

            try {
                const response = await axios(config)
                                
                this.user = response.data.user    
                this.token = response.data.token    
            } catch (error) {
                this.errMsg = error.response.data.message
                console.log(error);
            }           
        }
    }
})

